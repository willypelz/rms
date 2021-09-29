<?php

namespace App\Dtos;

use App\Models\Job;
use \Carbon\Carbon;
use \SeamlessHR\SolrPackage\Facades\SolrPackage;
use App\Models\JobApplication;
use \Maatwebsite\Excel\Excel as ConcreteExcel;

class DownloadApplicantSpreadsheetDto extends DownloadApplicantDto {

    /** 
    * @var int the row to search in solr
    */
    protected $search_row = 2147483647;

    /** 
    * @var array the excel data
    */
    protected $excel_data;

    /**
     * Initialize dto with the needed datas
    * @param array $data the data gotten from the request
    * @param string $type the type of download operation
    */
    public function initialize($data) : object
    {
        parent::initialize($data);
    
        $this->setPath($this->formatFilename());
        $this->setFilename( $this->formatFilename());
        return $this;
    }

    /**
     * Format Cv data for excel presentatons
    * @param array $data the cvs
    */
    function formatDataForExcelPresentation($data){

        foreach ($data as $key => $value) {

            if (!empty($this->getData()["cv_ids"]) && !in_array($value['id'], $this->getData()["cv_ids"])) {
                continue;
            }

            $tests = "";

            if (isset($value['test_status'])) {
                foreach ($value['test_status'] as $key2 => $test_status) {
                    if ($test_status == 'COMPLETED') {
                        $tests .= $value['test_name'][$key2] . "(" . @$value['test_score'][$key2] . ') ';
                    }
                }
            }

            $excel_data[$key] = [
                "FIRSTNAME" => @$value['first_name'],
                "LASTNAME" => @$value['last_name'],
                "LAST POSITION HELD" => @$value['last_position'],
                "HEADLINE" => @$value['headline'][0],
                "GENDER" => @$value['gender'],
                "MARITAL STATUS" => @$value['marital_status'],
                "DATE OF BIRTH" => substr(@$value['dob'], 0, 10),
                // "AGE" => '',
                "LOCATION" => @$value['state'],
                "EMAIL" => @$value['email'],
                "PHONE" => @$value['phone'],
                "COVER NOTE" => @$value['cover_note'][0],
                "HIGHEST EDUCATION" => @$value['highest_qualification'],
                "GRADUATION GRADE" => @getGrade($value['grade']),
                "LAST COMPANY WORKED AT" => @$value['last_company_worked'],
                "YEARS OF EXPERIENCE" => @$value['years_of_experience'],
                "WILLING TO RELOCATE?" => (array_key_exists('willing_to_relocate', $value) && $value['willing_to_relocate'] == "true") ? 'Yes' : 'No',
                "TESTS" => $tests,
            ];

            if(isset($value['application_id'][0])) {
               $jobApplication = JobApplication::with('custom_fields.form_field')->find($value['application_id'][0]);
               if(isset($jobApplication->custom_fields) ) {
                    foreach ($jobApplication->custom_fields as $value) {
                        if($value->form_field != null){
                        $excel_data[$key][$value->form_field->name] = $value->value;
                        }
                    }
                }
                //If applicant is an intenral staff
                if(isset($jobApplication->cv) && $jobApplication->cv->applicant_type == 'internal') {
                    $application = $jobApplication->cv;
                    $excel_data[$key]['INTERNAL STAFF'] = $application->applicant_type == 'internal' ? 'Yes' : 'No' ;
                    $excel_data[$key]['STAFF ID'] = $application->hrms_staff_id;
                    $excel_data[$key]['GRADE'] = $application->hrms_grade;
                    $excel_data[$key]['DEPARTMENT'] = $application->hrms_dept;
                    $excel_data[$key]['LOCATION'] = $application->hrms_location;
                    $excel_data[$key]['LENGTH OF STAY'] = $application->hrms_length_of_stay;
                }

            }

             $this->excel_data[$key] = $excel_data[$key];
          
        }

        return $this->excel_data;

    }

     /**
     * Get filename
    * @return string the file name of the file being exported
    */
    function getfilename() : string {
        return $this->filename;
    }

    /**
     * @todo Likely to remove this
     * Get excel data to export
    * @return array $data the excel data to export
    */
    function getExcelData() : array {
        $data = $this->getDataFromApplicants("docs");
        return $this ->formatDataForExcelPresentation($data);
    }

    /**
     * Get applicants data
     * @return array $data the excel data to export
     */
    function getApplicantsData() : array {
        return $this->getDataFromApplicants("docs");
    }


    /**
     * Format excel data file name to export
    * @return string $filename
    */
    protected function formatFilename(string $filename=null){
        $filename = $filename ?? 'Applicants Report - ' . $this->job->title .".". ConcreteExcel::XLSX;
        $filename = str_replace('/', '', $filename);
        $filename = str_replace('\'', '', $filename);
        return time() .$filename;
    }
    
    public function processApplicantsSpreedsheet(\Closure $next){
	    $this->getAllApplicantsFromSolr($next);
    }

}


?>
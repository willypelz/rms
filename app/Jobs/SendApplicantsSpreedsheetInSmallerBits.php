<?php

namespace App\Jobs;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ApplicantsExport;
use App\User;
use App\Models\Company;
use Maatwebsite\Excel\Facades\Excel;

class SendApplicantsSpreedsheetInSmallerBits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$data,$company,$filename,$cv_ids;
    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param array $data
     * @param $filename
     * @param $cv_ids
     * @param Company $company
     */
    public function __construct(array $data, Company $company, User $admin, $filename, $cv_ids)
    {
      $this->data = $data;
      $this->company = $company;
      $this->admin = $admin;
      $this->filename = $filename;
      $this->cv_ids = $cv_ids;
	    
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '1024M');
        set_time_limit(0);
      $excel_data = [];
            foreach ($this->data as $key => $value) {
                if (!empty($this->cv_ids) && !in_array($value['id'], $this->cv_ids)) {
                    continue;
                }
                $tests = "";

                if (@$value['test_status']) {
                    foreach (@$value['test_status'] as $key2 => $test_status) {

                        if ($test_status == 'COMPLETED') {
                            $tests .= @$value['test_name'][$key2] . "(" . @$value['test_score'][$key2] . ') ';
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
                    "COURSE OF STUDY"=> @$value['course_of_study'][0] ?? 'NA',
                    "SCHOOL"=> @$value['school'][0] ?? 'NA',
                    "APPLICANT TYPE" => @$value['applicant_type'] ?? 'NA',
                    "STAFF ID" => @$value['hrms_staff_id'] ?? 'NA',
                    "GRADE" => @$value['hrms_grade'] ?? 'NA',
                    "DEPARTMENT" => @$value['hrms_dept'] ?? 'NA',
                    "LOCATION" => @$value['hrms_location'] ?? 'NA',
                    "LENGTH OF STAY" => @$value['hrms_length_of_stay'] ?? 'NA'
             
                ];
                if(isset($value['application_id'][0])) {
                    $jobApplication = JobApplication::with('custom_fields.form_field')->find($value['application_id'][0]);
                    if($jobApplication){
                        foreach ($jobApplication->custom_fields as $value) {
                            if($value->form_field != null && isset($value->form_field->name)){
                                $excel_data[$key][strtoupper(str_slug($value->form_field->name,'_'))] = $value->value;
                            }
                        }
                    }
                }
            }

            (new ApplicantsExport($excel_data, $this->filename))->store($this->filename,\Maatwebsite\Excel\Excel::CSV);	
    }

}

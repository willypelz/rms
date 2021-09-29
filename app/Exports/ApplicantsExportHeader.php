<?php

namespace App\Exports;

use App\Models\Job;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ApplicantsExportHeader implements WithHeadings
{
    use Exportable;

    private $data,$file_name;
    protected static $static_file_name, $next_sn;


	public function __construct($data,$file_name)
	{
        $this->data = collect($data)->toArray();
        $this->file_name = $file_name;
        self::$static_file_name = $this->file_name;

	}

	public function headings(): array
    {
        
        $excel_data = [
            "FIRSTNAME" ,
            "LASTNAME",
            "LAST POSITION HELD" ,
            "HEADLINE" ,
            "GENDER" ,
            "MARITAL STATUS" ,
            "DATE OF BIRTH",
            "LOCATION",
            "EMAIL" ,
            "PHONE" ,
            "COVER NOTE" ,
            "HIGHEST EDUCATION" ,
            "GRADUATION GRADE" ,
            "LAST COMPANY WORKED AT" ,
            "YEARS OF EXPERIENCE" ,
            "WILLING TO RELOCATE?", 
            "TESTS", 
            "COURSE OF STUDY",
            "SCHOOL",
            "APPLICANT TYPE",
            "STAFF ID",
            "GRADE",
            "DEPARTMENT",
            "LOCATION",
            "LENGTH OF STAY"
        ];

            if(isset($this->data['job_id'][0])) {
                $job = Job::find($this->data['job_id'][0]);
                if($job){
                    foreach ($job->form_fields as $value) {
                            $excel_data[] = str_slug(strtoupper($value->name),'_');
                    }   
                     
                }
            }   

        return $excel_data;
    }

}

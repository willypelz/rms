<?php

namespace App\Exports;

use App\Models\JobApplication;
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
            "TESTS"
        ];

            if(isset($this->data['application_id'][0])) {
                $jobApplication = JobApplication::with('custom_fields.form_field')->find($this->data['application_id'][0]);
                if($jobApplication){
                    foreach ($jobApplication->custom_fields as $value) {
                        if($value->form_field != null){
                            $excel_data[] = $value->form_field->name;
                        }
                    }    
                }

                $excel_data = array_merge($excel_data,['INTERNAL STAFF','STAFF ID','GRADE','DEPARTMENT','LOCATION','LENGTH OF STAY']);      
            }   

        return $excel_data;
    }

}

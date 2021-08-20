<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use App\Models\Job;
use App\Models\JobApplication;

class ApplicantsExportHeader implements  WithHeadings
{
    use Exportable;

    private $data,$file_name;
    protected static $static_file_name, $next_sn;


	public function __construct($data,$file_name)
	{
        $this->data = collect($data)->toArray()[0];
        $this->file_name = $file_name;
        self::$static_file_name = $this->file_name;

	}


	/**
     * @return array
     */
    public function registerEvents(): array
    {	
    
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $styleArray = [
				    'borders' => [
				        'outline' => [
				            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
				            'color' => ['argb' => 'FFFF0000'],
				        ],
				    ],
				];

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->applyFromArray($styleArray);;
            },
        ];
    }


	public function headings(): array
    {
        
        $excel_data = [
            "SN",
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
        ];

    
        
            if(isset($this->data['job_id'][0])) {
                $job = Job::find($this->data['job_id'][0]);
                if($job){
                    foreach ($job->form_fields as $value) {
                            $excel_data[] = $value->name;
                    }    
                }
            }   

            $excel_data = array_merge($excel_data,['INTERNAL STAFF','STAFF ID','GRADE','DEPARTMENT','LOCATION','LENGTH OF STAY']);      
        
        return $excel_data;
    }

}

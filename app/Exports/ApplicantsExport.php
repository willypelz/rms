<?php

namespace App\Exports;

use App\JobApplication;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Files\LocalTemporaryFile;

class ApplicantsExport implements ShouldAutoSize, FromCollection, WithEvents
{
    use Exportable, RegistersEventListeners;

    private $data,$file_name;
    protected static $static_file_name, $next_sn;


	public function __construct($data,$file_name)
	{
        $this->data = $data;
        $this->file_name = $file_name;
        self::$static_file_name = $this->file_name;
	}


	/**
     * @return array
     */
    // public function registerEvents(): array
    // {	
    	

    //     return [
    //         AfterSheet::class    => function(AfterSheet $event) {
    //             $cellRange = 'A1:W1'; // All headers
    //             $styleArray = [
	// 			    'borders' => [
	// 			        'outline' => [
	// 			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
	// 			            'color' => ['argb' => 'FFFF0000'],
	// 			        ],
	// 			    ],
	// 			];

    //             $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->applyFromArray($styleArray);;
    //         },
    //     ];
    // }

    // public static function beforeExport(BeforeExport $event)
    // {
    //     $file = new LocalTemporaryFile(public_path('exports/' . self::$static_file_name));
    //     $event->writer->reopen($file, \Maatwebsite\Excel\Excel::CSV);
    //     $sheet = $event->writer->getSheetByIndex(0);
    //     static::$next_sn = $sheet->getHighestRow();
    //     $sheet->export($event->getConcernable());
    //     return $sheet;
    // }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $sn = static::$next_sn;
        foreach($this->data as &$data){
            $data = array_merge(['SN'=>++$sn],$data);
        }
        return collect($this->data);
    }

    public static function beforeWriting(BeforeWriting $event)
     {
        $file = new LocalTemporaryFile(public_path('exports/' . self::$static_file_name));
        $event->writer->reopen($file, \Maatwebsite\Excel\Excel::CSV);
        $sheet = $event->writer->getSheetByIndex(0);
        static::$next_sn = $sheet->getHighestRow();
        $sheet->export($event->getConcernable());
        return $sheet;
     
     }

     /**
* Before exporting, open the sheet you want to 
* add additional data to.
* 
* @param Maatwebsite\Excel\Events\BeforeExport $event 
* @param Maatwebsite\Excel\Files\LocalTemporaryFile $file
* 
* @return mixed
*/
// protected static function sheet($event, $file)
// {
//     $event->writer->reopen($file, \Maatwebsite\Excel\Excel::CSV);
//     $event->writer->getSheetByIndex(0);
//     $event->writer->getSheetByIndex(0)->export($event->getConcernable());
//     return $event->getWriter()->getSheetByIndex(0);
// }

}

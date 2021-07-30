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
use Maatwebsite\Excel\Files\LocalTemporaryFile;

class ApplicantsExport implements FromCollection, WithHeadings, WithEvents
{
    use Exportable, RegistersEventListeners;

	private $data,$link;
    protected static $static_file_name;


	public function __construct($data,$link)
	{
	    $this->data = $data;
        $this->link = $link;
        self::$static_file_name = $this->link;
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
        return array_keys(collect($this->data)->toArray()[0]);
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }

    /**
     * Before exporting, make sure the correct
     * existing sheet is retrieved
     *
     * @param mixed $event
     * @return \Maatwebsite\Excel\Sheet
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */

     public static function beforeWriting(BeforeWriting $event)
     {
         $file = new LocalTemporaryFile(storage_path('app/public').self::$static_file_name);
         $event->writer->reopen($file, \Maatwebsite\Excel\Excel::XLSX);
         $sheet = $event->writer->getSheetByIndex(0);
         $sheet->export($event->getConcernable());
         return $sheet;
     }
}

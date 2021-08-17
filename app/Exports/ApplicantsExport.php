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

	private $data;


	public function __construct($data)
	{
	    $this->data = $data;
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

}

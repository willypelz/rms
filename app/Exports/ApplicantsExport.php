<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

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
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $sn = static::$next_sn;

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

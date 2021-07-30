<?php

namespace App\Jobs;

use App\Dtos\DownloadApplicantSpreadsheetDto;
use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddApplicantToExportInBits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user, $filename, $link, $disk, $excelData, $sheetInstance;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $filename
     * @param $link
     * @param $disk
     * @param $excelData
     */
    public function __construct($sheetInstance, $user, $excelData)
    {
        $this->user = $user;
        $this->sheetInstance = $sheetInstance;
        $this->filename = $this->sheetInstance->getFilename();
        $this->link = $this->sheetInstance->getDownloadLink();
        $this->disk = $this->sheetInstance->getStorageDisk();
        $this->excelData = $excelData;
     }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){

          $excelData = $this->excelData;
         foreach ($excelData as $chunkedExcelData) {
			$this->dispatch( new SendApplicantsSpreedsheet($this->user, $chunkedExcelData, $this->filename, $this->link, $this->disk));
      
          }

    }
}

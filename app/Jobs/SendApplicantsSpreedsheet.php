<?php

namespace App\Jobs;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ApplicantsExport;
use App\Dtos\DownloadApplicantSpreadsheetDto;
use App\User;
use App\Notifications\NotifyAdminOfApplicantsSpreedsheetExportCompleted;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class SendApplicantsSpreedsheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $downloadApplicantSpreadsheetDto, $admin;

    public $timeout = 0;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param $excelData
     * @param $filename
     * @param $link
     * @param $disk
     */
    public function __construct(User $admin, DownloadApplicantSpreadsheetDto $downloadApplicantSpreadsheetDto)
    {
	    $this->admin = $admin;
	    $this->downloadApplicantSpreadsheetDto = $downloadApplicantSpreadsheetDto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sheetInstance = $this->downloadApplicantSpreadsheetDto;
        $applicantData = collect($sheetInstance->getApplicantsData())->chunk(1000)->toArray();
        $filename = $sheetInstance->getFilename();
        $link = $sheetInstance->getDownloadLink();
        $disk = $sheetInstance->getStorageDisk();
        $excel_file = storage_path($disk.'/'.$link);

        foreach ($applicantData as $data) {
            $excelData = $sheetInstance->formatDataForExcelPresentation($data);
            Excel::store( new ApplicantsExport($excelData, $link) , $link, $disk);
        }
        $this->admin->notify( new NotifyAdminOfApplicantsSpreedsheetExportCompleted($excel_file , $filename, $disk, $link));
    }


}

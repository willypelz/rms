<?php

namespace App\Jobs;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ApplicantsExportHeader;
use App\Dtos\DownloadApplicantSpreadsheetDto;
use App\User;
use App\Models\Company;
use App\Notifications\NotifyAdminOfApplicantsSpreedsheetExportCompleted;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class NotifyAdminOfCompletedExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename, $admin;

    public $timeout = 0;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param array $data
     * @param $filename
     * @param $link
     * @param $disk
     */
    public function __construct($filename, User $admin)
    {
      $this->filename = $filename;
      $this->admin = $admin; 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $this->admin->notify( new NotifyAdminOfApplicantsSpreedsheetExportCompleted($this->filename));
                          
    }
}

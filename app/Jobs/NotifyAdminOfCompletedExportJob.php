<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Notifications\NotifyAdminOfApplicantsSpreedsheetExportCompleted;
use Maatwebsite\Excel\Facades\Excel;

class NotifyAdminOfCompletedExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filename, $admin,$type,$jobId, $sheetId;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param  $jobId
     * @param $filename
     */
    public function __construct($filename, User $admin,$type, $jobId=null, $sheetId = null)
    {
      $this->filename = $filename;
      $this->admin = $admin; 
      $this->jobId = $jobId; 
      $this->type = $type; 
      $this->queue = "export";
      $this->sheetId = $sheetId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $this->admin->notify( new NotifyAdminOfApplicantsSpreedsheetExportCompleted($this->filename,$this->type,$this->jobId, $this->admin, $this->sheetId));

    }
}

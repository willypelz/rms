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
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class CreateSheetHeader implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename, $data;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param array $data
     * @param $filename
     * @param $link
     * @param $disk
     */
    public function __construct($filename, $data)
    {
      $this->filename = $filename;
      $this->data = $data; 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        (new ApplicantsExportHeader($this->data, $this->filename))->store($this->filename, \Maatwebsite\Excel\Excel::CSV);
    }
}

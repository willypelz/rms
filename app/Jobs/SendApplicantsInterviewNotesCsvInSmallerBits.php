<?php

namespace App\Jobs;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\InterviewNoteExport;
use App\Jobs\SendApplicantsSpreedsheetInSmallerBits;
use App\User;
use App\Models\Company;
use Maatwebsite\Excel\Facades\Excel;

class SendApplicantsInterviewNotesCsvInSmallerBits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$application_ids,$company,$filename;
    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param array $application_ids
     * @param $filename
     * @param Company $company
     */

    public function __construct(array $application_ids, Company $company, User $admin, $filename)
    {
      $this->application_ids = $application_ids;
      $this->company = $company;
      $this->admin = $admin;
      $this->filename = $filename;
      $this->queue = "export";
	    
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      (new InterviewNoteExport($this->application_ids,$this->filename,$this->company,$this->admin))->store($this->filename,\Maatwebsite\Excel\Excel::CSV);
    }
}

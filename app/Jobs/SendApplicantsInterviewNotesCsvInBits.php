<?php

namespace App\Jobs;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ApplicantsExport;
use App\Jobs\SendApplicantsInterviewNotesCsvInSmallerBits;
use App\User;
use App\Models\Company;
use Maatwebsite\Excel\Facades\Excel;

class SendApplicantsInterviewNotesCsvInBits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$applicant_ids,$company,$filename;
    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param array $applicant_ids
     * @param $filename
     * @param Company $company
     */

    public function __construct(array $applicant_ids, Company $company, User $admin, $filename)
    {
      $this->applicant_ids = $applicant_ids;
      $this->company = $company;
      $this->admin = $admin;
      $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '1024M');
        set_time_limit(0);
	    $data_chunk = collect($this->applicant_ids)->chunk(100)->toArray();
        foreach($data_chunk as $data){
            SendApplicantsInterviewNotesCsvInSmallerBits::dispatch($data,$this->company,$this->admin,$this->filename)->delay(10);
        }
    }

}

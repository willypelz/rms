<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\SendApplicantsInterviewNotesCsvInBits;
use App\User;
use App\Models\Company;
use Maatwebsite\Excel\Facades\Excel;


class SendApplicantsInterviewNotesCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$application_ids,$company,$filename,$cv_ids;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param array $application_ids
     * @param $filename
     * @param $cv_ids
     * @param Company $company
     */

    public function __construct(array $application_ids, Company $company, User $admin, $filename)
    {
      $this->application_ids = $application_ids;
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
      $data_chunk = collect($this->application_ids)->chunk(300)->toArray();
        foreach($data_chunk as $data){
          SendApplicantsInterviewNotesCsvInBits::dispatch($data,$this->company,$this->admin,$this->filename)->delay(10);
        }
    }

}

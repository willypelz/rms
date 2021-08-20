<?php

namespace App\Jobs;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ApplicantsExport;
use App\Jobs\SendApplicantsSpreedsheetInBits;
use App\User;
use App\Models\Company;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class SendApplicantsSpreedsheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$data,$company,$filename;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param array $data
     * @param $filename
     * @param $link
     * @param $disk
     */
    public function __construct(array $data, Company $company, User $admin, $filename)
    {
      $this->data = $data;
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
      $data_chunk = collect($this->data)->chunk(100);
        foreach($data_chunk as $data){
            SendApplicantsSpreedsheetInBits::dispatch($dat,$this->company,$this->admin,$this->filename);
        }
    }

}

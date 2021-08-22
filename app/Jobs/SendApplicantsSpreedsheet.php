<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\SendApplicantsSpreedsheetInBits;
use App\User;
use App\Models\Company;
use Maatwebsite\Excel\Facades\Excel;


class SendApplicantsSpreedsheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$data,$company,$filename,$cv_ids;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param array $data
     * @param $filename
     * @param $cv_ids
     * @param Company $company
     */
    public function __construct(array $data, Company $company, User $admin, $filename,$cv_ids)
    {
      $this->data = $data;
      $this->company = $company;
      $this->admin = $admin;
      $this->filename = $filename;
      $this->cv_ids = $cv_ids;
	    
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
      $data_chunk = collect($this->data)->chunk(300)->toArray();
        foreach($data_chunk as $data){
            SendApplicantsSpreedsheetInBits::dispatch($data,$this->company,$this->admin,$this->filename,$this->cv_ids);
        }
    }

}

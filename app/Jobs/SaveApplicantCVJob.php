<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Dtos\DownloadApplicantCvDto;
use App\User;
use App\Jobs\NotifyAdminOfCompletedExportJob;



class SaveApplicantCVJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $zipPath, $cvs,$filename,$admin,$jobId;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param  $zipPath
     * @param $cvs
     * @param $filename
     * @param $admin
     * @param $jobId
     *
     */
    public function __construct($zipPath, $cvs,$filename,$admin,$jobId)
    {
	    $this->zipPath = $zipPath;
        $this->cvs = $cvs;
        $this->filename = $filename;
        $this->admin = $admin;
        $this->jobId = $jobId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cvChunked = collect($this->cvs)->chunk(500)->toArray();

            $batch_count = 1;
            foreach($cvChunked as $chunk){
                SaveApplicantCVInBitsJob::dispatch($this->zipPath,$chunk);

                    if($batch_count == count($cvChunked)){ //This ensures email sends only in the last batch loop
                        $type = "Applicant CVs"; 
                        NotifyAdminOfCompletedExportJob::dispatch($this->filename,$this->admin,$type,$this->jobId)->delay(120); 
                    }
                $batch_count ++;
            }
    }

}

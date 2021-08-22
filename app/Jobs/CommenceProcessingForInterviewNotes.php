<?php

namespace App\Jobs;


use App\User;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use App\Jobs\CreateSheetHeader;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\NotifyAdminOfCompletedExportJob;
use App\Jobs\SaveApplicantCVJob;
use App\Jobs\SaveApplicantNotesZip;

class CommenceProcessingForInterviewNotes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$company,$filename,$application_ids,$jobId,$download_type;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param object $application_ids
     * @param int $jobId
     * @param string $download_type
     * @param Company $company
     * @param User $admin
     * @param $filename
     * 
     */
    public function __construct(Company $company, User $admin, Object $application_ids,int $jobId, $filename,$download_type)
    {
      $this->company = $company;
      $this->admin = $admin;
      $this->filename = $filename;
      $this->application_ids = $application_ids;
      $this->jobId = $jobId;
      $this->download_type = $download_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      switch($this->download_type){
        case "Interview Notes ZIP":
          $chunk = collect($this->application_ids)->chunk(500)->toArray();
           foreach($chunk as $notes){
              $batch_count = 1;
              SaveApplicantNotesZip::dispatch($notes,$this->filename,$this->jobId,$this->company,$this->admin);
              $batch_count ++;
              if($batch_count == count($chunk)){ //This ensures email sends only in the last batch loop
                $type = "Applicant Notes ZIP"; 
                NotifyAdminOfCompletedExportJob::dispatch($this->filename,$this->admin,$type,$this->jobId)->delay(120); 
              }
          }
        break;
        case "Interview Notes CSV":
        break;
        default:
        return null;
      }
     
            // $zipPath = $path . $this->filename;
            // SaveApplicantCVJob::dispatch($zipPath,$cvs,$this->filename,$this->admin,$this->jobId);
          

     }


}

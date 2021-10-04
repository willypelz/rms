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
use App\Jobs\SendApplicantsInterviewNotesCsv;
use App\Jobs\CreateInterviewNoteSheetHeader;
use App\Notifications\NotifyAdminOfFailedDownload;

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
      $this->queue = "export";
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
        ini_set('memory_limit', '1024M');
        set_time_limit(0);
        $batch_count = 0;
          $chunk = collect($this->application_ids)->chunk(300)->toArray();
           foreach($chunk as $notes){
              SaveApplicantNotesZip::dispatch($notes,$this->filename,$this->jobId,$this->company,$this->admin);
              ++$batch_count;
            }
            if($batch_count == count($chunk)){ //This ensures email sends only in the last batch loop
              $type = "Applicant Notes ZIP"; 
              NotifyAdminOfCompletedExportJob::dispatch($this->filename,$this->admin,$type,$this->jobId)->delay(120); 
            }
        break;
        case "Interview Notes CSV":
        //create excel sheet header in readiness for the excel data insertion 
        
        $header = collect($this->application_ids)->toArray()[0] ?? null;
              CreateInterviewNoteSheetHeader::dispatch($this->filename, $header);

              $chunked_applicants =  collect($this->application_ids)->chunk(500)->toArray();
              $chunk_count = count($chunked_applicants);
              $counter = 0;
              foreach($chunked_applicants as $data){
                      ++$counter;
                SendApplicantsInterviewNotesCsv::dispatch($data,$this->company,$this->admin,$this->filename)->delay(10);  
              }
              if($counter == $chunk_count){
                      $type = "Applicant Notes CSV";
                      NotifyAdminOfCompletedExportJob::dispatch($this->filename,$this->admin,$type,$this->jobId)->delay(120); 
              }
        
        break;
        default:
        //implement null action
      }

     }
     public function failed(){
      $type = "Interview Notes";
      $this->fail($this->admin->notify(new NotifyAdminOfFailedDownload($this->admin, $type, $this->jobId)));
    }
}

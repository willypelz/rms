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
use SeamlessHR\SolrPackage\Facades\SolrPackage;

class CommenceProcessingForApplicantsSpreedsheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$company,$filename,$search_params, 
              $jobId, $status,$solr_age, $solr_exp_years, 
              $solr_video_application_score, $solr_test_score,$cv_ids;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param array $search_params
     * @param int $jobId
     * @param string $status
     * @param Company $company
     * @param array $data
     * @param $filename
     * @param $link
     * @param $disk
     */
    public function __construct(Company $company, User $admin, $filename, array $search_params, 
                                int $jobId, $status, $solr_age=null, $solr_exp_years=null, 
                                $solr_video_application_score=null, $solr_test_score=null,$cv_ids=null)
    {
      $this->company = $company;
      $this->admin = $admin;
      $this->filename = $filename;
      $this->search_params = $search_params;
      $this->jobId = $jobId;
      $this->status = $status;
      $this->solr_age = $solr_age;
      $this->solr_exp_years = $solr_exp_years;
      $this->solr_video_application_score = $solr_video_application_score;
      $this->solr_test_score = $solr_test_score;
      $this->cv_ids = $cv_ids;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $applicants =  $this->getApplicants(); 
        $response = $applicants['response'];
        $number_found = $response["numFound"];
        $header = $response['docs'][0];   

       //create excel sheet header in readiness for the excel data insertion 
        CreateSheetHeader::dispatch($this->filename, $header);
        $chunked_applicants =  collect($response['docs'])->chunk(500)->toArray();
        $chunk_count = count($chunked_applicants);
        $counter = 0;

        foreach($chunked_applicants as $data){
                ++$counter;
           SendApplicantsSpreedsheet::dispatch($data,$this->company,$this->admin,$this->filename,$this->cv_ids)->delay(\Carbon\Carbon::now()->addSeconds(10));  
        }
        if($counter == $chunk_count){
                $type = "Applicant Spreadsheet";
                NotifyAdminOfCompletedExportJob::dispatch($this->filename,$this->admin,$type,$this->jobId)->delay(\Carbon\Carbon::now()->addSeconds($number_found < 4000 ? 60 : 240)); 
        }
     }


    private function getApplicants(){
          return SolrPackage::get_applicants($this->search_params, $this->jobId, @$this->status,
                                             @$this->solr_age, @$this->solr_exp_years,
                                             @$this->solr_video_application_score, @$this->solr_test_score);
    }

}

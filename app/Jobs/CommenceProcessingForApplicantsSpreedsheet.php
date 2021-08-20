<?php

namespace App\Jobs;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ApplicantsExport;
use App\Exports\ApplicantsExportHeader;
use App\Dtos\DownloadApplicantSpreadsheetDto;
use SeamlessHR\SolrPackage\Facades\SolrPackage;
use App\User;
use App\Jobs\CreateSheetHeader;
use App\Jobs\NotifyAdminOfCompletedExportJob;
use App\Models\Company;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use App\Notifications\NotifyAdminOfApplicantsSpreedsheetExportCompleted;

class CommenceProcessingForApplicantsSpreedsheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$company,$filename,$search_params, $jobId, $status,$solr_age, $solr_exp_years, 
                $solr_video_application_score, $solr_test_score;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param User $admin
     * @param array $data
     * @param $filename
     * @param $link
     * @param $disk
     */
    public function __construct(array $search_params, $jobId, $status,$solr_age=null, $solr_exp_years=null, 
                                $solr_video_application_score=null, $solr_test_score=null,
                                Company $company, User $admin, $filename)
    {
      $this->company = $company;
      $this->admin = $admin;
      $this->filename = $filename;
      $this->search_params = $search_params;
      $this->jobId = $jobId;
      $this->status = $status;
      $solr_age = $solr_age;
      $solr_exp_years = $solr_exp_years;
      $solr_video_application_score = $solr_video_application_score;
      $solr_test_score = $solr_test_score;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $default_solr_row_size = 500;
        $applicants =  $this->getPaginatedApplicants(0, $default_solr_row_size); 
        $header = $applicants['response']['docs'][0];      
        $total_count = $applicants["response"]["numFound"]; 
        $current_count = 0;
        $perc = (100/($total_count/$default_solr_row_size));
        $t =0;
                CreateSheetHeader::dispatch($this->filename, $header);
                while(($start = $current_count * $default_solr_row_size )  < $total_count){
                        ++$current_count;
                        $result=  $this->getPaginatedApplicants($start, $default_solr_row_size);
                        info($start);
                        $data = $result['response']['docs'];
                        SendApplicantsSpreedsheet::dispatch($data,$this->company,$this->admin,$this->filename)->delay(\Carbon\Carbon::now()->addSeconds(10));
                        $t+=$perc;
                        info('percentage is - '. $t);
                }
                NotifyAdminOfCompletedExportJob::dispatch($this->filename,$this->admin)->delay(\Carbon\Carbon::now()->addSeconds(60)); 
                    
                     info("Applicants Retrieved Successfully from Solr.");   
    }

    private function getPaginatedApplicants($start, $default_solr_row_size){
            $this->search_params["start"] = $start;
            $this->search_params["rows"] = $default_solr_row_size;
          return SolrPackage::get_applicants($this->search_params, $this->jobId, @$this->status,
                                             @$this->solr_age, @$this->solr_exp_years,
                                             @$this->solr_video_application_score, @$this->solr_test_score);
    }

}

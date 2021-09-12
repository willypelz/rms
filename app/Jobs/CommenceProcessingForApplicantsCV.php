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
use SeamlessHR\SolrPackage\Facades\SolrPackage;
use App\Notifications\NotifyAdminOfFailedDownload;


class CommenceProcessingForApplicantsCV implements ShouldQueue
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
     * @param User $admin
     * @param $filename
     * 
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
            $result =  $this->getApplicants();   
            $data = $result['response']['docs'];
            $path = storage_path('app/public/uploads/export/'); //public_path('exports/');
            $cvs = array_pluck($data, 'cv_file');
            $ids = array_pluck($data, 'id');


        //Check for selected cvs to download and append path to it
        $cvs = array_map(function ($cv, $id) {

            if (!empty($this->cv_ids) && !in_array($id, $this->cv_ids)) {
                return null;
            }

            if (!file_exists(public_path('uploads/CVs/') . $cv)) {
                return null;
            }

            if (is_null($cv) or $cv == "") {
                return null;
            }

            return public_path('uploads/CVs/') . $cv;
            }, $cvs, $ids);



          //Remove nulls
          $cvs = array_values(array_filter($cvs));

          //TODO: Implement DB flag whne cv is empty
          // if cvs are empty return back
         
          if(count($cvs) < 1) {
            info('cv is empty');
            $type = "Applicant CVs";
            $this->fail($this->admin->notify(new NotifyAdminOfFailedDownload($this->admin, $type, $this->jobId)));
            // return redirect()->back()->with('error', 'The candidates do not have any cv\'s and can\'t be downloaded');
          }elseif(count($cvs) > 0){
            $zipPath = $path . $this->filename;
            SaveApplicantCVJob::dispatch($zipPath,$cvs,$this->filename,$this->admin,$this->jobId);
          }

     }


    private function getApplicants(){
          return SolrPackage::get_applicants($this->search_params, $this->jobId, @$this->status,
                                             @$this->solr_age, @$this->solr_exp_years,
                                             @$this->solr_video_application_score, @$this->solr_test_score);
    }
    public function failed(){
      $type = "Applicant CVs";
      $this->fail($this->admin->notify(new NotifyAdminOfFailedDownload($this->admin, $type, $this->jobId)));
    }
}

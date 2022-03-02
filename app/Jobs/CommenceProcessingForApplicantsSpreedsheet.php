<?php

namespace App\Jobs;


use App\Events\SpreadSheetGenerated;
use App\Helpers\SearchEngineable;
use App\Helpers\SpreadsheetExport\SpreadSheetExporter;
use App\Jobs\CreateSheetHeader;
use App\Jobs\NotifyAdminOfCompletedExportJob;
use App\Models\JobApplication;
use App\Models\SpreadSheetDoneExporting;
use App\Notifications\NotifyAdminOfApplicantsSpreedsheetExportCompleted;
use App\User;
use App\Models\Company;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use SeamlessHR\SolrPackage\Facades\SolrPackage;
use App\Notifications\NotifyAdminOfFailedDownload;

class CommenceProcessingForApplicantsSpreedsheet extends SearchEngineable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin,$jobId,$filename;

    public $timeout = 2500;
    protected $exporter;

    /**
     * Create a new job instance.
     * @param array $search_params
     * @param int $jobId
     * @param string $status
     * @param Company $company
     * @param User $admin
     * @param array $data
     * @param $filename
     *
     */
    public function __construct(Company $company, User $admin, $filename, array $search_params,
                                int     $jobId, $status, $solr_age = null, $solr_exp_years = null,
                                        $solr_video_application_score = null, $solr_test_score = null, $cv_ids = null)
    {

        $data = compact('company', 'admin', 'filename', 'search_params',
            'jobId', 'status', 'solr_age', 'solr_exp_years',
            'solr_video_application_score', 'solr_test_score', 'cv_ids'
        );

        $this->exporter = (new SpreadSheetExporter($data));
        $this->admin = $admin;
        $this->jobId = $jobId;
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        $sheets = $this->exporter->getExportSheets();

        $batch = Bus::batch($sheets)->then(function (Batch $batch) {
            // All jobs completed successfully...
        })->catch(function (Batch $batch, \Throwable $e) {
            // First batch job failure detected...
        })->finally(function (Batch $batch) {

        })->onQueue('export')->dispatch();


        SpreadSheetDoneExporting::firstOrCreate(
            [
                'batch_id' => $batch->id,
                'admin_id' => $this->admin->id,
                'data' => [
                    'filename' => $this->filename,
                    'type' => "Applicant Spreadsheet",
                    'jobId' => $this->jobId,
                    'admin' => $this->admin
                ]

            ]
        );
    }


    public function failed($exception)
    {
        dd($exception);
        $type = "Applicant Spreadsheet";
    }

    public function batchComplete()
    {
        $type = "Applicant Spreadsheet";

        $this->fail($this->admin->notify(new NotifyAdminOfFailedDownload($this->admin, $type, $this->jobId)));
    }

}

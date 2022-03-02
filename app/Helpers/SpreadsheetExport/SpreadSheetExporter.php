<?php

namespace App\Helpers\SpreadsheetExport;


use App\Helpers\SearchEngineable;
use App\Jobs\CreateSheetHeader;
use App\Jobs\SendApplicantsSpreedsheetInSmallerBits;
use App\Models\JobApplication;

class SpreadSheetExporter extends SearchEngineable
{
    protected $admin, $company, $filename, $search_params,
        $jobId, $status, $solr_age, $solr_exp_years,
        $solr_video_application_score, $solr_test_score, $cv_ids, $queue, $paginateBy = 100;

    public function __construct(array $data)
    {
        parent::__construct();

        $this->company = $data['company'];
        $this->admin = $data['admin'];
        $this->filename = $data['filename'];
        $this->search_params = $data['search_params'];
        $this->jobId = $data['jobId'];
        $this->status = $data['status'];
        $this->solr_age = $data['solr_age'];
        $this->solr_exp_years = $data['solr_exp_years'];
        $this->solr_video_application_score = $data['solr_video_application_score'];
        $this->solr_test_score = $data['solr_test_score'];
        $this->cv_ids = $data['cv_ids'];
        $this->queue = "export";
    }

    public function getExportSheets(): array
    {
        $totalApplications = JobApplication::whereHas('job', function ($job) {
            $job->where('id', $this->jobId);
        })->count();

        $this->search_params['paginationCount'] = $this->paginateBy;
        $batches = floor(($totalApplications / 20)) + 1;

        $page = 1;
        $exports = [];

        while ($page <= $batches) {
            $this->search_params['start'] = $page * $this->paginateBy;
            $data = $this->getApplicants()['response']['docs'];

            if (!empty($data)) {
                if ($page == 1) {
                    CreateSheetHeader::dispatch($this->filename, $data[0]);
                }
                $exports [] = (new SendApplicantsSpreedsheetInSmallerBits($data, $this->company, $this->admin, $this->filename, $this->cv_ids));
            }

            $page++;
        }
        return $exports;
    }

    private function getApplicants()
    {
        return $this->searchEngine->get_applicants($this->search_params, $this->jobId, @$this->status, @$this->admin->client_id,
            @$this->solr_age, @$this->solr_exp_years,
            @$this->solr_video_application_score, @$this->solr_test_score);
    }
}
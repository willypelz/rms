<?php

namespace App\Jobs;

use App\Libraries\Solr;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SeamlessHR\SolrPackage\Facades\SolrPackage;

class UploadApplicant implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    var $applicant;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(is_null($this->applicant->job))
            return false;

            $applicant = $this->applicant;

            $cand['gender'] = $applicant->cv->gender ?? null;
            $cand['last_company_worked'] = $applicant->cv->last_company_worked ?? null;
            $cand['dob'] = $applicant->cv->date_of_birth ?? null;
            $cand['cv_file'] = $applicant->cv->cv_file ?? null;
            $cand['display_picture'] = $applicant->cv->display_picture ?? null;
            $cand['years_of_experience'] = $applicant->cv->years_of_experience ?? null;
            $cand['extracted_content'] = [0];
            $cand['rank'] = 1;
            $cand['id'] = $applicant->cv_id ?? null;
            $cand['state'] = $applicant->cv->state ?? null;
            $cand['first_name'] = $applicant->cv->first_name ?? null;
            $cand['last_name'] = $applicant->cv->last_name ?? null;
            $cand['headline'] = $applicant->cv->headline ?? null;
            $cand['last_modified'] = $applicant->cv->last_modified ?? null;
            $cand['grade'] = $applicant->cv->graduation_grade ?? null;
            $cand['willing_to_relocate'] = $applicant->cv->willing_to_relocate ? true : false;
            $cand['email'] = $applicant->cv->email ?? null;
            $cand['last_position'] = $applicant->cv->last_position ?? null;
            $cand['cv_source'] = $applicant->cv->cv_source ?? null;
            $cand['highest_qualification'] = $applicant->cv->highest_qualification ?? null;
            $cand['marital_status'] = $applicant->cv->marital_status ?? null;
            $cand['phone'] = $applicant->cv->phone ?? null;
            $cand['state_of_origin'] = $applicant->cv->state_of_origin ?? null;
            $cand['cover_note'] = $applicant->cover_note ?? null;
            $cand['job_id'] = $applicant->job_id ?? null;
            $cand['application_date'] = $applicant->created ?? null;
            $cand['application_modified'] = $applicant->created ?? null;
            $cand['application_id'] = $applicant->id ?? null;
            $cand['is_approved'] = $applicant->is_approved ?? null;
            $cand['application_status'] = $applicant->status ?? null;
            $cand['job_title'] = $applicant->job->title ?? null;

            SolrPackage::create_new_document($cand);
    }
}

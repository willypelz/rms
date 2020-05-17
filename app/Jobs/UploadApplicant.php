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

            $cand['gender'] = $applicant->cv->gender;
            $cand['last_company_worked'] = $applicant->cv->last_company_worked;
            $cand['dob'] = $applicant->cv->date_of_birth;
            $cand['cv_file'] = $applicant->cv->cv_file;
            $cand['display_picture'] = $applicant->cv->display_picture;
            $cand['years_of_experience'] = $applicant->cv->years_of_experience;
            $cand['extracted_content'] = [0];
            $cand['rank'] = 1;
            $cand['id'] = $applicant->cv_id;
            $cand['state'] = $applicant->cv->state;
            $cand['first_name'] = $applicant->cv->first_name;
            $cand['last_name'] = $applicant->cv->last_name;
            $cand['headline'] = $applicant->cv->headline;
            $cand['last_modified'] = $applicant->cv->last_modified;
            $cand['grade'] = $applicant->cv->graduation_grade;
            $cand['willing_to_relocate'] = $applicant->cv->willing_to_relocate ? true : false;
            $cand['email'] = $applicant->cv->email;
            $cand['last_position'] = $applicant->cv->last_position;
            $cand['cv_source'] = $applicant->cv->cv_source;
            $cand['highest_qualification'] = $applicant->cv->highest_qualification;
            $cand['marital_status'] = $applicant->cv->marital_status;
            $cand['phone'] = $applicant->cv->phone;
            $cand['state_of_origin'] = $applicant->cv->state_of_origin;
            $cand['cover_note'] = $applicant->cover_note;
            $cand['job_id'] = $applicant->job_id;
            $cand['application_date'] = $applicant->created;
            $cand['application_modified'] = $applicant->created;
            $cand['application_id'] = $applicant->id;
            $cand['is_approved'] = $applicant->is_approved;
            $cand['application_status'] = $applicant->status;
            $cand['job_title'] = $applicant->job->title;

            SolrPackage::create_new_document($cand);
    }
}

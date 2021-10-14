<?php

namespace App\Jobs;

use App\Libraries\Solr;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use SeamlessHR\SolrPackage\Facades\SolrPackage;

class UploadApplicant implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    var $applicant;

    public $timeout = 2000;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        //$applicant refers to JobApplication table
        $this->applicant = $applicant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '1024M');
        set_time_limit(0);

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
            $cand['course_of_study'] = $applicant->cv->course_of_study ?? null;
            $cand['school'] = $applicant->cv->school->name ?? null;
            $cand['applicant_type'] = $applicant->cv->applicant_type ?? null;
            $cand['hrms_staff_id'] = $applicant->cv->hrms_staff_id ?? null;
            $cand['hrms_grade'] = $applicant->cv->hrms_grade ?? null;
            $cand['hrms_dept'] = $applicant->cv->hrms_dept ?? null;
            $cand['hrms_location'] = $applicant->cv->hrms_location ?? null;
            $cand['hrms_length_of_stay'] = $applicant->cv->hrms_length_of_stay ?? null;
            
            //custom fields
            foreach ($this->applicant->custom_fields as $key=>$value) {
                if($value->form_field != null && isset($value->form_field->name) && isset($value->value)){
                    $cand['custom_field_name'][] = str_slug($value->form_field->name,'_');
                    $cand['custom_field_value'][] = ($value->value ?? null);
                }
            }
            info('commenced push to solr');
            SolrPackage::create_new_document($cand);
    }
}

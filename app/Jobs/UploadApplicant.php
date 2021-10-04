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

            $cand['gender'] = $applicant->cv->gender ?? 'NA';
            $cand['last_company_worked'] = $applicant->cv->last_company_worked ?? 'NA';
            $cand['dob'] = $applicant->cv->date_of_birth ?? 'NA';
            $cand['cv_file'] = $applicant->cv->cv_file ?? 'NA';
            $cand['display_picture'] = $applicant->cv->display_picture ?? 'NA';
            $cand['years_of_experience'] = $applicant->cv->years_of_experience ?? 'NA';
            $cand['extracted_content'] = [0];
            $cand['rank'] = 1;
            $cand['id'] = $applicant->cv_id ?? 'NA';
            $cand['state'] = $applicant->cv->state ?? 'NA';
            $cand['first_name'] = $applicant->cv->first_name ?? 'NA';
            $cand['last_name'] = $applicant->cv->last_name ?? 'NA';
            $cand['headline'] = $applicant->cv->headline ?? 'NA';
            $cand['last_modified'] = $applicant->cv->last_modified ?? 'NA';
            $cand['grade'] = $applicant->cv->graduation_grade ?? 'NA';
            $cand['willing_to_relocate'] = $applicant->cv->willing_to_relocate ? true : false;
            $cand['email'] = $applicant->cv->email ?? 'NA';
            $cand['last_position'] = $applicant->cv->last_position ?? 'NA';
            $cand['cv_source'] = $applicant->cv->cv_source ?? 'NA';
            $cand['highest_qualification'] = $applicant->cv->highest_qualification ?? 'NA';
            $cand['marital_status'] = $applicant->cv->marital_status ?? 'NA';
            $cand['phone'] = $applicant->cv->phone ?? 'NA';
            $cand['state_of_origin'] = $applicant->cv->state_of_origin ?? 'NA';
            $cand['cover_note'] = $applicant->cover_note ?? 'NA';
            $cand['job_id'] = $applicant->job_id ?? 'NA';
            $cand['application_date'] = $applicant->created ?? 'NA';
            $cand['application_modified'] = $applicant->created ?? 'NA';
            $cand['application_id'] = $applicant->id ?? 'NA';
            $cand['is_approved'] = $applicant->is_approved ?? 'NA';
            $cand['application_status'] = $applicant->status ?? 'NA';
            $cand['job_title'] = $applicant->job->title ?? 'NA';
            $cand['course_of_study'] = $applicant->cv->course_of_study ?? 'NA';
            $cand['school'] = $applicant->cv->school->name ?? 'NA';
            $cand['applicant_type'] = $applicant->cv->applicant_type ?? 'NA';
            $cand['hrms_staff_id'] = $applicant->cv->hrms_staff_id ?? 'NA';
            $cand['hrms_grade'] = $applicant->cv->hrms_grade ?? 'NA';
            $cand['hrms_dept'] = $applicant->cv->hrms_dept ?? 'NA';
            $cand['hrms_location'] = $applicant->cv->hrms_location ?? 'NA';
            $cand['hrms_length_of_stay'] = $applicant->cv->hrms_length_of_stay ?? 'NA';
            
            //custom fields
            foreach ($this->applicant->custom_fields as $key=>$value) {
                if($value->form_field != null && isset($value->form_field->name)){
                    $cand[str_slug($value->form_field->name,'_')] = ($value->value ?? 'NA');
                }
            }

            SolrPackage::create_new_document($cand);
    }
}

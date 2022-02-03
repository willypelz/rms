<?php

namespace App\Models;

use App\Libraries\Solr;
use App\Jobs\UploadApplicant;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use SeamlessHR\SolrPackage\Facades\SolrPackage;

class JobApplication extends Model
{
    use Searchable;

    public $guarded = [];

    public $timestamps = false;

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function cv()
    {
        return $this->belongsTo('App\Models\Cv', 'cv_id');
    }

    public static function massAction($job_id, $cv_ids, $status, $step_id)
    {

        
        $step = WorkflowStep::with('approvals')->find($step_id);

        $data = [];

        $is_approved = true;
        if ($step->requires_approval) {
            $is_approved = false;
        }
        $data += ['is_approved' => $is_approved];

        $app = JobApplication::where('job_id', $job_id)
            ->whereIn('cv_id', $cv_ids)
            ->update($data + ['status' => $status]);

        $applicants = JobApplication::where('job_id', $job_id)->whereIn('cv_id', $cv_ids)->get();

        foreach ($applicants as $applicant) {
            UploadApplicant::dispatch($applicant)->onQueue('solr');                
        }

        return $app;
    }


    public function requests()
    {

        return $this->hasMany('App\Models\AtsRequest');

    }

    public function interview_notes()
    {

        return $this->hasMany('App\Models\InterviewNotes');

    }

    public function custom_fields()
    {
        return $this->hasMany('App\Models\FormFieldValues');
    }

    public function candidate()
    {
        return $this->belongsTo('App\Models\Candidate', 'candidate_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'job_application_id');
    }

    public function testRequests()
    {

        return $this->hasMany('App\Models\TestRequest');
    }

    public function toSearchableArray()
    {
        $cand = [];
        if (is_null($this->job) ) {
            return $cand;
        } 
        $applicant = $this;
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
        $cand['company_id'] = optional($applicant->job)->company_id ?? null;
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
        $cand['edu_school'] = $applicant->cv->school->name ?? null;
        $cand['specializations'] = $applicant->cv->specializations->pluck("name")->toArray() ?? null;
        $cand['completed_nysc'] = ($applicant->cv->completed_nysc ?? null);
        $cand['graduation_grade'] = (int)($applicant->cv->graduation_grade ?? null);
        $cand['minimum_remuneration'] = (int) ($applicant->job->minimum_remuneration ?? null);
        $cand['maximum_remuneration'] = (int) ($applicant->job->maximum_remuneration ?? null);
        //custom fields
        foreach ($this->custom_fields as $key => $value) {
            if ($value->form_field != null && isset($value->form_field->name) && isset($value->value)) {
                $cand['custom_field_name'][] = str_slug($value->form_field->name, '_');
                $cand['custom_field_value'][] = ($value->value ?? null);
            }
        }
        if (count($applicant->testRequests)) {
            $applicant->testRequests->map(
                function ($score) use (&$cand) {
                    // $cand['test_id'][] = $score->test_id ?? null;
                    $cand['test_name'][] = $score->test_name ?? null;
                    $cand['test_owner'][] = $score->provider->name ?? null;
                    $cand['test_result_comment'][] = $score->result_comment ?? null;
                    $cand['test_score'][] = $score->score ?? null;
                    $cand['test_status'][] = $score->status ?? null;
                }
            );
        }
        return $cand;
    }
}
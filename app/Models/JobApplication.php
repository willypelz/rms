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

    protected $casts = [
        'is_approved'  => 'bool'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function cv()
    {
        return $this->belongsTo('App\Models\Cv', 'cv_id');
    }

    public function cvSelected()
    {
        return $this->belongsTo(Cv::class, 'cv_id')->select('id', 'email');
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
        if (is_null($this->job)) {
            return $cand;
        }

        $applicant = $this;
        $cand['gender'] = $applicant->cv->gender ?? "none";
        $cand['last_company_worked'] = $applicant->cv->last_company_worked ?? "none";
        $cand['dob'] = $applicant->cv->date_of_birth ?? "none";
        $cand['cv_file'] = $applicant->cv->cv_file ?? "none";
        $cand['display_picture'] = $applicant->cv->display_picture ?? "none";
        $cand['years_of_experience'] = $applicant->cv->years_of_experience ?? "none";
        $cand['extracted_content'] = [0];
        $cand['rank'] = 1;
        $cand['id'] = $applicant->cv_id ?? "none";
        $cand['state'] = $applicant->cv->state ?? "none";
        $cand['first_name'] = $applicant->cv->first_name ?? "none";
        $cand['last_name'] = $applicant->cv->last_name ?? "none";
        $cand['headline'] = $applicant->cv->headline ?? "none";
        $cand['last_modified'] = $applicant->cv->last_modified ?? "none";
        $cand['grade'] = $applicant->cv->graduation_grade ?? "none";
        $cand['willing_to_relocate'] = $applicant->cv->willing_to_relocate ?? false;
        $cand['email'] = $applicant->cv->email ?? "none";
        $cand['last_position'] = $applicant->cv->last_position ?? "none";
        $cand['cv_source'] = $applicant->cv->cv_source ?? "none";
        $cand['highest_qualification'] = $applicant->cv->highest_qualification ?? "none";
        $cand['marital_status'] = $applicant->cv->marital_status ?? "none";
        $cand['phone'] = $applicant->cv->phone ?? "none";
        $cand['state_of_origin'] = $applicant->cv->state_of_origin ?? "none";
        $cand['cover_note'] = $applicant->cover_note ?? "none";
        $cand['job_id'] = $applicant->job_id ?? "none";
        $cand['company_id'] = optional($applicant->job)->company_id ?? "none";
        $cand['application_date'] = $applicant->created ?? "none";
        $cand['application_modified'] = $applicant->created ?? "none";
        $cand['application_id'] = $applicant->id ?? "none";
        $cand['is_approved'] = $applicant->is_approved ?? "none";
        $cand['application_status'] = $applicant->status ?? "none";
        $cand['job_title'] = $applicant->job->title ?? "none";
        $cand['course_of_study'] = $applicant->cv->course_of_study ?? "none";
        $cand['school'] = $applicant->cv->school->name ?? "none";
        $cand['applicant_type'] = $applicant->cv->applicant_type ?? "none";
        $cand['hrms_staff_id'] = $applicant->cv->hrms_staff_id ?? "none";
        $cand['hrms_grade'] = $applicant->cv->hrms_grade ?? "none";
        $cand['hrms_dept'] = $applicant->cv->hrms_dept ?? "none";
        $cand['hrms_location'] = $applicant->cv->hrms_location ?? "none";
        $cand['hrms_length_of_stay'] = $applicant->cv->hrms_length_of_stay ?? "none";
        $cand['edu_school'] = $applicant->cv->school->name ?? "none";
        $cand['specializations'] = optional($applicant->cv)->specializations ? $applicant->cv->specializations->pluck("name")->toArray() : "none";
        $cand['completed_nysc'] = ($applicant->cv->completed_nysc ?? "none");
        $cand['graduation_grade'] = (int)($applicant->cv->graduation_grade ?? "none");
        $cand['minimum_remuneration'] = (int) ($applicant->job->minimum_remuneration ?? "none");
        $cand['maximum_remuneration'] = (int) ($applicant->job->maximum_remuneration ?? "none");
        //custom fields
        foreach ($this->custom_fields as $key => $value) {
            if ($value->form_field != null && isset($value->form_field->name) && isset($value->value)) {
                $cand['custom_field_name'][] = str_slug($value->form_field->name, '_');
                $cand['custom_field_value'][] = ($value->value ?? "none");
            }
        }
        if (count($applicant->testRequests)) {
            $applicant->testRequests->map(
                function ($score) use (&$cand) {
                    // $cand['test_id'][] = $score->test_id ?? "none";
                    $cand['test_name'][] = $score->test_name ?? "none";
                    $cand['test_owner'][] = $score->provider->name ?? "none";
                    $cand['test_result_comment'][] = $score->result_comment ?? "none";
                    $cand['test_score'][] = $score->score ?? "none";
                    $cand['test_status'][] = $score->status ?? "none";
                }
            );
        }
        return $cand;
    }

}

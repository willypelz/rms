<?php

namespace App\Models;

use App\Jobs\UploadApplicant;
use App\Libraries\Solr;
use Illuminate\Database\Eloquent\Model;
use SeamlessHR\SolrPackage\Facades\SolrPackage;

class JobApplication extends Model
{
    //

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
        return $this->hasMany('App\Models\Message','job_application_id');
    }
}

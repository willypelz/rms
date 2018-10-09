<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Solr;

class JobApplication extends Model
{
    //

    public $guarded = [];

    public $timestamps = false;

    public function job()
    {
        return $this->belongsTo('App\Models\Job', 'job_id');
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

        Solr::update_core();

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
}

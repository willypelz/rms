<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public static function massAction($job_id, $cv_ids, $status)
    {
        return JobApplication::where('job_id',$job_id)
                                ->whereIn('cv_id',$cv_ids)
                                ->update( ['status'=>$status] );
    }


    public function requests(){

        return $this->hasMany('App\Models\AtsRequest');

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    //

    public $guarded = [];

    public $timestamps = true;

    public function job()
    {
        return $this->belongsTo('App\Models\Job', 'job_id');
    }

    public function cv()
    {
        return $this->belongsTo('App\Models\Cv', 'cv_id');
    }
}

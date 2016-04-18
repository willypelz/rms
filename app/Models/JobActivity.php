<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobActivity extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_activities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'job_id', 'job_application_id', 'activity_type', 'comment', 'created_at'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

     public function application()
    {
        return $this->belongsTo('App\Models\JobApplication', 'job_application_id');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\Job', 'job_id');
    }
    
}

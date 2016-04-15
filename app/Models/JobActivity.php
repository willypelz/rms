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
    protected $fillable = ['user_id', 'job_id', 'job_application_id', 'activity_type', 'comment'];

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'details', 'location', 'post_date', 'expiry_date', 'job_type', 'qualification', 'published', 'experience'];


    public function boards()
    {
        return $this->belongsToMany('App\Models\JobBoard', 'jobs_job_boards');
    }

}

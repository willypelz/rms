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
    protected $fillable = ['title', 'details', 'company_id', 'location', 'status', 'post_date', 'expiry_date', 'job_level', 'position', 'published', 'experience'];


    public function boards()
    {
        return $this->belongsToMany('App\Models\JobBoard', 'jobs_job_boards');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

}

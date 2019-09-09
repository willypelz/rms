<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

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
    protected $fillable = [
        'title',
        'summary',
        'details',
        'company_id',
        'workflow_id',
        'location',
        'status',
        'post_date',
        'expiry_date',
        'job_level',
        'position',
        'published',
        'experience',
        'fields',
        'is_for',
        'job_type'
    ];


    public function setIsForAttribute($value)
    {
        $this->attributes['is_for'] = strtolower($value);
    }

    public function boards()
    {
        return $this->belongsToMany('App\Models\JobBoard', 'jobs_job_boards')->withPivot('url', 'url');
    }

    public function specializations()
    {
        return $this->belongsToMany('App\Models\Specialization', 'jobs_specializations');
    }


    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function form_fields()
    {
        return $this->hasMany('App\Models\FormFields');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\JobActivity');
    }

    public static function getMyJobIds()
    {
        return Job::where('company_id', @get_current_company()->id)->where('status', '!=',
            'DELETED')->get()->pluck('id')->toArray();
    }

    public static function getMyJobs()
    {
        return Job::where('company_id', @get_current_company()->id)->where('status', '!=', 'DELETED')->get()->toArray();
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'job_users')->withPivot('role', 'role_id', 'role_name');
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function applicants()
    {
        return $this->belongsToMany(Cv::class, 'job_applications', 'job_id', 'cv_id');
    }

    public function applicantsViaJAT() // JAT - Job Applications Table
    {
        return $this->hasMany(JobApplication::class);
    }

}

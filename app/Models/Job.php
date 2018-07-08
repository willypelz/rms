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
    protected $fillable = ['title', 'details', 'company_id', 'location', 'status', 'post_date', 'expiry_date', 'job_level', 'position', 'published', 'experience'];


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
        return Job::where('company_id',@get_current_company()->id)->where('status','!=','DELETED')->get()->pluck('id')->toArray();
    }

    public static function getMyJobs()
    {
        return Job::whereIn('company_id', Auth::user()->companies->pluck('id') )->where('status','!=','DELETED')->get()->toArray();
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'job_users')->withPivot('role');
    }

}

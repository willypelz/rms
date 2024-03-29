<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    //
	protected $fillable = [
        'extracted_content','first_name','last_name',
        'headline','email','phone','gender','date_of_birth',
        'marital_status','state','highest_qualification',
        'last_position','last_company_worked','years_of_experience',
        'graduation_grade','willing_to_relocate','cv_file',
        'candidate_id','applicant_type','state_of_origin',
        'hrms_staff_id','hrms_grade','hrms_dept','hrms_location',
        'hrms_length_of_stay','school_id','completed_nysc',
        'course_of_study','minimum_renumeration','maximum_renumeration'
    ];

    public $timestamps = false;

     public function specializations()
    {
        return $this->belongsToMany('App\Models\Specialization', 'cvs_specializations');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School', 'school_id');
    }

}

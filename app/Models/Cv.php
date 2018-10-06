<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cv extends Authenticatable
{
    //
	protected $fillable = ['extracted_content','first_name','last_name','headline','email','phone','gender','date_of_birth','marital_status','state','highest_qualification','last_position','last_company_worked','years_of_experience','graduation_grade','willing_to_relocate','cv_file'];

    public $timestamps = false;

     public function specializations()
    {
        return $this->belongsToMany('App\Models\Specialization', 'cvs_specializations');
    }
}

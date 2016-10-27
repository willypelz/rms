<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormFields extends Model
{
    //
    public $guarded = [];

     /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type', 'options', 'job_id', 'created_at', 'updated_at'];

    // public $timestamps = false;

    protected $table = 'form_fields';

    //Sorry, this was a mistake :), noticed later but too late to change
    public static function getCustomFields($job_id)
    {
    	return FormFields::where('job_id',$job_id)->get();
    }
}

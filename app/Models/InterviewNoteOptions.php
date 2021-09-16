<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewNoteOptions extends Model
{
    //
    public $guarded = [];

     /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','header' ,'type', 'options', 'weight_min', 'weight_max', 'job_id', 'created_at', 'updated_at','company_id','interview_template_id','check_box'];

    // public $timestamps = false;

    protected $table = 'interview_note_options';

    //Sorry, this was a mistake :), noticed later but too late to change
    public static function getCustomFields($job_id)
    {
    	return FormFields::where('job_id',$job_id)->get();
    }

    public function interview_note_template()
    {
        return $this->hasOne('App\Models\InterviewNoteTemplates','id','interview_template_id');
    }
}

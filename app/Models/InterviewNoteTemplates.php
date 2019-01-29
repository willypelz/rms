<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewNoteTemplates extends Model
{
    //
    public $guarded = [];

     /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','company_id'];

    // public $timestamps = false;

    protected $table = 'interview_note_templates';

    public function options()
    {
        return $this->hasMany('App\Models\InterviewNoteOptions','interview_template_id','id');
    }

}

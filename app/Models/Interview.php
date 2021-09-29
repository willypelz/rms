<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    //
    public $guarded = [];

    public $timestamps = false;

    protected $table = 'interview';

    public function users()
    {
      return $this->belongsToMany('App\User');
    }

    public function interviewNoteTemplate()
    {
      return $this->belongsToMany('App\Models\InterviewNoteTemplate', 'interview_interview_note_templates');
    }
}

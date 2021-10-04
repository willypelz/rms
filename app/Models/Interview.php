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

    public function templates()
    {
      return $this->belongsToMany('App\Models\InterviewNoteTemplates', 'interview_interview_note_template','interview_id', 'interview_note_template_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewNotes extends Model
{
    //
    public $guarded = [];

    public $timestamps = false;

    protected $table = 'interview_notes';

    public function user()
    {
        return $this->belongsTo('App\User', 'interviewer_id');
    }

}

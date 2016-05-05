<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewNotes extends Model
{
    //
    public $guarded = [];

    public $timestamps = false;

    protected $table = 'interview_notes';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewNoteValues extends Model
{
    //
    public $guarded = [];

     /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['interview_note_option_id', 'value', 'job_application_id', 'created_at', 'updated_at'];

    // public $timestamps = false;

    protected $table = 'interview_note_values';

    public function video_option()
    {
        return $this->hasOne('App\Models\VideoApplicationOptions','id','form_field_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
	protected $fillable = ['job_application_id','user_id','message','attachment','created_at','updated_at','deleted_at','title','description'];

    public function job_application(){

        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }
}

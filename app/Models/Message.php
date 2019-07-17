<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
	protected $fillable = ['job_application_id','user_id','message','attachment','created_at','updated_at','deleted_at','title'];


}

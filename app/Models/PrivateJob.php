<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateJob extends Model
{
    //
    protected $guarded = [];

    public function job(){
        return $this->belongsTo('App/Models/Job', 'job_id');
    }
}

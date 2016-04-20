<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    //

    public $timestamps = false;

     public function specializations()
    {
        return $this->belongsToMany('App\Models\Specialization', 'cvs_specializations');
    }
}

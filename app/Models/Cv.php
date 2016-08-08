<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    //
	protected $fillable = ['extracted_content'];

    public $timestamps = false;

     public function specializations()
    {
        return $this->belongsToMany('App\Models\Specialization', 'cvs_specializations');
    }
}

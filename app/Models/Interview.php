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
}

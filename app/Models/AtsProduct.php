<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtsProduct extends Model
{
    //
    public $guarded = [];

    public function provider()
    {
        return $this->belongsTo('App\Models\AtsProvider', 'ats_provider_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtsProduct extends Model
{
    //
    public $guarded = [];
    public $timestamps = false;

    public function provider()
    {
        return $this->belongsTo('App\Models\AtsProvider', 'ats_provider_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\AtsService', 'ats_service_id');
    }
}

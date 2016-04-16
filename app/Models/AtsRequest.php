<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtsRequest extends Model
{
    //
    public $guarded = [];


    public function product()
    {
        return $this->belongsTo('App\Models\AtsProduct', 'ats_product_id');
    }
    
}

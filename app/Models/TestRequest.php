<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestRequest extends Model
{
    //
    public $guarded = [];


    public function product()
    {
        return $this->belongsTo('App\Models\AtsProduct', 'test_id');
    }
    public function provider()
    {
        return $this->belongsTo('App\Models\AtsProvider', 'test_owner');
    }
    
}

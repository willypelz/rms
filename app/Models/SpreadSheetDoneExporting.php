<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpreadSheetDoneExporting extends Model
{
    use HasFactory;
    protected $casts = [
      'data' => 'array'
    ];
    protected $guarded = ['id'];
}

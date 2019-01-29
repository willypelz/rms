<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
    //
    public $guarded = [];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id', 'type_id', 'type','image','title','amount', 'created_at','updated_at','count'];

    protected $table = 'invoice_items';
}

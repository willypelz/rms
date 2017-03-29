<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    //
    public $guarded = [];


    protected $table = 'invoices';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'status', 'company_id', 'initiated_by', 'created_at','updated_at'];

    public function items()
    {
    	return $this->hasMany('App\Models\InvoiceItems','invoice_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

}

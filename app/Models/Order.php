<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'order_date', 'type', 'total_amount', 'discount', 'invoice_no', 'trans_id', 'customer_id', 'customer_card'];

     public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

}

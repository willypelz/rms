<?php

namespace App\Observers;

use App\Models\OrderItem;

class OrderItemObserver
{
    /**
     * Handle the order item "created" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function created(OrderItem $orderItem)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a Order Item',
                'description' => 'created an order'.''.$orderItem->name,
                'action_id' => $orderItem->id,
                'action_type' => 'App\Models\OrderItem',
                'causee_id' => '',
                'causer_id' => auth()->user()->id,
                'causer_type' => '',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the order item "updated" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function updated(OrderItem $orderItem)
    {
        //
    }

    /**
     * Handle the order item "deleted" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function deleted(OrderItem $orderItem)
    {
        //
    }

    /**
     * Handle the order item "restored" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function restored(OrderItem $orderItem)
    {
        //
    }

    /**
     * Handle the order item "force deleted" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function forceDeleted(OrderItem $orderItem)
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Models\Invoices;

class InvoicesObserver
{
    /**
     * Handle the invoices "created" event.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return void
     */
    public function created(Invoices $invoices)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a Invoices',
                'description' => 'Created a new invoice',
                'action_id' => $invoices->id,
                'action_type' => 'App\Models\invoices',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                'causer_type' => '',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the invoices "updated" event.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return void
     */
    public function updated(Invoices $invoices)
    {
        //
    }

    /**
     * Handle the invoices "deleted" event.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return void
     */
    public function deleted(Invoices $invoices)
    {
        //
    }

    /**
     * Handle the invoices "restored" event.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return void
     */
    public function restored(Invoices $invoices)
    {
        //
    }

    /**
     * Handle the invoices "force deleted" event.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return void
     */
    public function forceDeleted(Invoices $invoices)
    {
        //
    }
}

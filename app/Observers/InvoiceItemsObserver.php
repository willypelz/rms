<?php

namespace App\Observers;

use App\Models\InvoiceItems;

class InvoiceItemsObserver
{
    /**
     * Handle the invoice items "created" event.
     *
     * @param  \App\Models\InvoiceItems  $invoiceItems
     * @return void
     */
    public function created(InvoiceItems $invoiceItems)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a Invoices Model',
                'description' => 'Created a new invoice',
                'action_id' => $invoiceItems->id,
                'action_type' => 'App\Models\InvoiceItems',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                'causer_type' => '',
                'properties' => '',
            ];
            logAction($param);
           
        }
        
    }

    /**
     * Handle the invoice items "updated" event.
     *
     * @param  \App\Models\InvoiceItems  $invoiceItems
     * @return void
     */
    public function updated(InvoiceItems $invoiceItems)
    {
        //
    }

    /**
     * Handle the invoice items "deleted" event.
     *
     * @param  \App\Models\InvoiceItems  $invoiceItems
     * @return void
     */
    public function deleted(InvoiceItems $invoiceItems)
    {
        //
    }

    /**
     * Handle the invoice items "restored" event.
     *
     * @param  \App\Models\InvoiceItems  $invoiceItems
     * @return void
     */
    public function restored(InvoiceItems $invoiceItems)
    {
        //
    }

    /**
     * Handle the invoice items "force deleted" event.
     *
     * @param  \App\Models\InvoiceItems  $invoiceItems
     * @return void
     */
    public function forceDeleted(InvoiceItems $invoiceItems)
    {
        //
    }
}

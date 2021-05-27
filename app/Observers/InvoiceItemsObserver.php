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
                'action_type' => 'Create',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                //'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
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

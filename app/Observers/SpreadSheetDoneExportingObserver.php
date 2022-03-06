<?php

namespace App\Observers;

use App\Models\SpreadSheetDoneExporting;

class SpreadSheetDoneExportingObserver
{
    /**
     * Handle the SpreadSheetDoneExporting "created" event.
     *
     * @param  \App\Models\SpreadSheetDoneExporting  $spreadSheetDoneExporting
     * @return void
     */
    public function created(SpreadSheetDoneExporting $spreadSheetDoneExporting)
    {

    }

    /**
     * Handle the SpreadSheetDoneExporting "updated" event.
     *
     * @param  \App\Models\SpreadSheetDoneExporting  $spreadSheetDoneExporting
     * @return void
     */
    public function updated(SpreadSheetDoneExporting $spreadSheetDoneExporting)
    {
        //
    }

    /**
     * Handle the SpreadSheetDoneExporting "deleted" event.
     *
     * @param  \App\Models\SpreadSheetDoneExporting  $spreadSheetDoneExporting
     * @return void
     */
    public function deleted(SpreadSheetDoneExporting $spreadSheetDoneExporting)
    {
        //
    }

    /**
     * Handle the SpreadSheetDoneExporting "restored" event.
     *
     * @param  \App\Models\SpreadSheetDoneExporting  $spreadSheetDoneExporting
     * @return void
     */
    public function restored(SpreadSheetDoneExporting $spreadSheetDoneExporting)
    {
        //
    }

    /**
     * Handle the SpreadSheetDoneExporting "force deleted" event.
     *
     * @param  \App\Models\SpreadSheetDoneExporting  $spreadSheetDoneExporting
     * @return void
     */
    public function forceDeleted(SpreadSheetDoneExporting $spreadSheetDoneExporting)
    {
        //
    }
}

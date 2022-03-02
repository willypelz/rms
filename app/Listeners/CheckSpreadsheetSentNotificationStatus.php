<?php

namespace App\Listeners;

use App\Models\SpreadSheetDoneExporting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;

class CheckSpreadsheetSentNotificationStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        SpreadSheetDoneExporting::where('id', $event->notification->sheetId)->delete();
    }
}

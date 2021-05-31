<?php

namespace App\Observers;

use App\Models\AtsRequest;

class AtsRequestObserver
{
    /**
     * Handle the ats request "created" event.
     *
     * @param  \App\Models\AtsRequest  $atsRequest
     * @return void
     */
    public function created(AtsRequest $atsRequest)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a AtsRequest',
                'description' => 'Created AtsRequest'.' '.$atsRequest->service_type,
                'action_id' => $atsRequest->id,
                'action_type' => 'App\Models\AtsRequest',
                'causee_id' => '',
                'causer_id' =>  auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the ats request "updated" event.
     *
     * @param  \App\Models\AtsRequest  $atsRequest
     * @return void
     */
    public function updated(AtsRequest $atsRequest)
    {
        //
    }

    /**
     * Handle the ats request "deleted" event.
     *
     * @param  \App\Models\AtsRequest  $atsRequest
     * @return void
     */
    public function deleted(AtsRequest $atsRequest)
    {
        //
    }

    /**
     * Handle the ats request "restored" event.
     *
     * @param  \App\Models\AtsRequest  $atsRequest
     * @return void
     */
    public function restored(AtsRequest $atsRequest)
    {
        //
    }

    /**
     * Handle the ats request "force deleted" event.
     *
     * @param  \App\Models\AtsRequest  $atsRequest
     * @return void
     */
    public function forceDeleted(AtsRequest $atsRequest)
    {
        //
    }
}

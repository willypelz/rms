<?php

namespace App\Observers;

use App\Models\Cv;

class CvObserver
{
    /**
     * Handle the cv "created" event.
     *
     * @param  \App\Models\Cv  $cv
     * @return void
     */
    public function created(Cv $cv)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a Cv Model',
                'description' => 'created a candidate Cv',
                'action_id' => $cv->id,
                'action_type' => 'App\Models\Cv',
                'causee_id' => $cv->candidate_id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',                
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the cv "updated" event.
     *
     * @param  \App\Models\Cv  $cv
     * @return void
     */
    public function updated(Cv $cv)
    {
        //
    }

    /**
     * Handle the cv "deleted" event.
     *
     * @param  \App\Models\Cv  $cv
     * @return void
     */
    public function deleted(Cv $cv)
    {
        //
    }

    /**
     * Handle the cv "restored" event.
     *
     * @param  \App\Models\Cv  $cv
     * @return void
     */
    public function restored(Cv $cv)
    {
        //
    }

    /**
     * Handle the cv "force deleted" event.
     *
     * @param  \App\Models\Cv  $cv
     * @return void
     */
    public function forceDeleted(Cv $cv)
    {
        //
    }
}

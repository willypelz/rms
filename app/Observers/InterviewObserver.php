<?php

namespace App\Observers;

use App\Models\Interview;

class InterviewObserver
{
    /**
     * Handle the interview "created" event.
     *
     * @param  \App\Models\Interview  $interview
     * @return void
     */
    public function created(Interview $interview)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a InterviewObserver Model',
                'description' => 'Created a new Interview',
                'action_id' => $interview->id,
                'action_type' => 'Create',
                'causee_id' => $interview->user->id,
                'causer_id' =>  auth()->user()->id,
                //'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the interview "updated" event.
     *
     * @param  \App\Models\Interview  $interview
     * @return void
     */
    public function updated(Interview $interview)
    {
        //
    }

    /**
     * Handle the interview "deleted" event.
     *
     * @param  \App\Models\Interview  $interview
     * @return void
     */
    public function deleted(Interview $interview)
    {
        //
    }

    /**
     * Handle the interview "restored" event.
     *
     * @param  \App\Models\Interview  $interview
     * @return void
     */
    public function restored(Interview $interview)
    {
        //
    }

    /**
     * Handle the interview "force deleted" event.
     *
     * @param  \App\Models\Interview  $interview
     * @return void
     */
    public function forceDeleted(Interview $interview)
    {
        //
    }
}

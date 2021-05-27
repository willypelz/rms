<?php

namespace App\Observers;

use App\Models\Candidate;

class CandidateObserver
{
    /**
     * Handle the candidate "created" event.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return void
     */
    public function created(Candidate $candidate)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a Candidate Model',
                'description' => 'A new candidate info created',
                'action_id' => $candidate->id,
                'action_type' => 'Create',
                'causee_id' => auth()->guard('candidate')->user()->id,
                'causer_id' =>  auth()->guard('candidate')->user()->id,
                //'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the candidate "updated" event.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return void
     */
    public function updated(Candidate $candidate)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Update a Candidate Model',
                'description' => 'updated the candidate info',
                'action_id' => $candidate->id,
                'action_type' => 'Update',
                'causee_id' => auth()->guard('candidate')->user()->id,
                'causer_id' =>  auth()->guard('candidate')->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the candidate "deleted" event.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return void
     */
    public function deleted(Candidate $candidate)
    {
        //
    }

    /**
     * Handle the candidate "restored" event.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return void
     */
    public function restored(Candidate $candidate)
    {
        //
    }

    /**
     * Handle the candidate "force deleted" event.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return void
     */
    public function forceDeleted(Candidate $candidate)
    {
        //
    }
}

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
                'log_name' => 'Created a Candidate',
                'description' => 'A new candidate info created',
                'action_id' => $candidate->id,
                'action_type' => 'App\Models\Candidate',
                'causee_id' => auth()->guard('candidate')->user()->id,
                'causer_id' =>  auth()->guard('candidate')->user()->id,
                'causer_type' => 'applicant',
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
                'log_name' => 'Update a Candidate',
                'description' => 'updated the candidate info',
                'action_id' => $candidate->id,
                'action_type' => 'App\Models\Candidate',
                'causee_id' => auth()->guard('candidate')->user()->id,
                'causer_id' =>  auth()->guard('candidate')->user()->id,
                'causer_type' => 'Applicant',
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

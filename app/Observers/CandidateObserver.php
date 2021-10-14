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
                'log_name' => 'Candidate Registration',
                'description' => $candidate->getNameAttribute().''.'registered',
                'action_id' => $candidate->id,
                'action_type' => 'App\Models\Candidate',
                'causee_id' => auth()->guard('candidate')->id ?? null,
                'causer_id' =>  auth()->guard('candidate')->id ?? null,
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
                'log_name' => 'Updated Candidate Info',
                'description' => $candidate->getNameAttribute().' '.'profile was updated',
                'action_id' => $candidate->id,
                'action_type' => 'App\Models\Candidate',
                'causee_id' => auth()->guard('candidate')->id ?? null,
                'causer_id' =>  auth()->guard('candidate')->id ?? null,
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

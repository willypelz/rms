<?php

namespace App\Observers;

use App\Models\Job;

class JobObserver
{
    /**
     * Handle the job "created" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function created(Job $job)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a Job',
                'description' => 'Created a new Job',
                'action_id' => $job->id,
                'action_type' => 'App\Models\Job',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'Admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the job "updated" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function updated(Job $job)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Updated a Job',
                'description' => 'Updated a Job',
                'action_id' => $job->id,
                'action_type' => 'App\Models\Job',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'Admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the job "deleted" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function deleted(Job $job)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Delete a Job',
                'description' => 'Deleted a Job',
                'action_id' => $job->id,
                'action_type' => 'App\Models\Job',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'Admin',
                'properties' => '',
            ];

            logAction($param);
           
        }
    }

    /**
     * Handle the job "restored" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function restored(Job $job)
    {
        //
    }

    /**
     * Handle the job "force deleted" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function forceDeleted(Job $job)
    {
        //
    }
}

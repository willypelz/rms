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
                'log_name' => 'Create a Job Model',
                'description' => 'created a new Job',
                'action_id' => $job->id,
                'action_type' => 'Create',
                'causee_id' => $auth()->user()->id,
                'causer_id' => $auth()->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
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
                'log_name' => 'Updated a Job Model',
                'description' => 'Updated a Job',
                'action_id' => $job->id,
                'action_type' => 'Updated',
                'causee_id' => $auth()->user()->id,
                'causer_id' => $auth()->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
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

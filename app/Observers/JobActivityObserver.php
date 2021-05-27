<?php

namespace App\Observers;

use App\Models\JobActivity;

class JobActivityObserver
{
    /**
     * Handle the job activity "created" event.
     *
     * @param  \App\Models\JobActivity  $jobActivity
     * @return void
     */
    public function created(JobActivity $jobActivity)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a JobActivity Model',
                'description' => 'created the a job activity',
                'action_id' => $jobActivity->id,
                'action_type' => 'Create',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the job activity "updated" event.
     *
     * @param  \App\Models\JobActivity  $jobActivity
     * @return void
     */
    public function updated(JobActivity $jobActivity)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Update a JobActivity Model',
                'description' => 'updated the following'.''.$request->all(),
                'action_id' => '',
                'action_type' => 'Update',
                'causee_id' => $request->id,
                'causer_id' => Auth::user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the job activity "deleted" event.
     *
     * @param  \App\Models\JobActivity  $jobActivity
     * @return void
     */
    public function deleted(JobActivity $jobActivity)
    {
        //
    }

    /**
     * Handle the job activity "restored" event.
     *
     * @param  \App\Models\JobActivity  $jobActivity
     * @return void
     */
    public function restored(JobActivity $jobActivity)
    {
        //
    }

    /**
     * Handle the job activity "force deleted" event.
     *
     * @param  \App\Models\JobActivity  $jobActivity
     * @return void
     */
    public function forceDeleted(JobActivity $jobActivity)
    {
        //
    }
}

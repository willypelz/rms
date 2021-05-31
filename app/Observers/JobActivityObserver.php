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
                'log_name' => 'Create a JobActivity',
                'description' => 'created the a job activity',
                'action_id' => $jobActivity->id,
                'action_type' => 'App\Models\JobActivity',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => '',
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
                'log_name' => 'Update on JobActivity',
                'description' => 'updated the job activity',
                'action_id' => $jobActivity->id,
                'action_type' => 'App\Models\JobActivity',
                'causee_id' => $request->id,
                'causer_id' => Auth::user()->id,
                'causer_type' => '',
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

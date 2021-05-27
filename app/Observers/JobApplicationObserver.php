<?php

namespace App\Observers;

use App\Models\JobApplication;

class JobApplicationObserver
{
    /**
     * Handle the job application "created" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function created(JobApplication $jobApplication)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a Company Model',
                'description' => 'created the api_key',
                'action_id' => $jobApplication->id,
                'action_type' => 'Create',
                'causee_id' => $jobApplication->candidate_id,
                'causer_id' => auth()->guard('candidate')->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the job application "updated" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function updated(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Handle the job application "deleted" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function deleted(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Handle the job application "restored" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function restored(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Handle the job application "force deleted" event.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return void
     */
    public function forceDeleted(JobApplication $jobApplication)
    {
        //
    }
}

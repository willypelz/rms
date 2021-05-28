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
                'log_name' => 'Create a new job application',
                'description' => 'created a job application',
                'action_id' => $jobApplication->id,
                'action_type' => 'App\Models\JobApplication',
                'causee_id' => $jobApplication->candidate_id,
                'causer_id' => auth()->guard('candidate')->user()->id,
                'causer_type' => 'applicant',
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

<?php

namespace App\Observers;

use App\Models\JobApplicationMessage;

class JobApplicationMessageObserver
{
    /**
     * Handle the job application message "created" event.
     *
     * @param  \App\Models\JobApplicationMessage  $jobApplicationMessage
     * @return void
     */
    public function created(JobApplicationMessage $jobApplicationMessage)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a JobApplication Model',
                'description' => 'created a job application',
                'action_id' => $jobApplicationMessage->id,
                'action_type' => 'App\Models\JobApplicationMessage',
                'causee_id' => $jobApplicationMessage>candidate_id,
                'causer_id' => auth()->guard('candidate')->user()->id,
                'causer_type' => 'applicant',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the job application message "updated" event.
     *
     * @param  \App\Models\JobApplicationMessage  $jobApplicationMessage
     * @return void
     */
    public function updated(JobApplicationMessage $jobApplicationMessage)
    {
        //
    }

    /**
     * Handle the job application message "deleted" event.
     *
     * @param  \App\Models\JobApplicationMessage  $jobApplicationMessage
     * @return void
     */
    public function deleted(JobApplicationMessage $jobApplicationMessage)
    {
        //
    }

    /**
     * Handle the job application message "restored" event.
     *
     * @param  \App\Models\JobApplicationMessage  $jobApplicationMessage
     * @return void
     */
    public function restored(JobApplicationMessage $jobApplicationMessage)
    {
        //
    }

    /**
     * Handle the job application message "force deleted" event.
     *
     * @param  \App\JobApplicationMessage  $jobApplicationMessage
     * @return void
     */
    public function forceDeleted(JobApplicationMessage $jobApplicationMessage)
    {
        //
    }
}

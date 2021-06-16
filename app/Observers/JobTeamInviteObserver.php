<?php

namespace App\Observers;

use App\Models\JobTeamInvite;

class JobTeamInviteObserver
{
    /**
     * Handle the job team invite "created" event.
     *
     * @param  \App\Models\JobTeamInvite  $jobTeamInvite
     * @return void
     */
    public function created(JobTeamInvite $jobTeamInvite)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created an Invite',
                'description' => 'created a job invite',
                'action_id' => $jobTeamInvite->id,
                'action_type' => 'App\Models\JobTeamInvite',
                'causee_id' => '',
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);

           
        }
    }

    /**
     * Handle the job team invite "updated" event.
     *
     * @param  \App\Models\JobTeamInvite  $jobTeamInvite
     * @return void
     */
    public function updated(JobTeamInvite $jobTeamInvite)
    {
        //
        // if(auth()->check()){
        //     $param = [
        //         'log_name' => 'Update a JobActivity Model',
        //         'description' => 'updated the following'.''.$request->all(),
        //         'action_id' => '',
        //         'action_type' => 'Updates',
        //         'causee_id' => $request->id,
        //         'causer_id' => Auth::user()->id,
        //         // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
        //         'properties' => '',
        //     ];
        //     logAction($param);
           
        // }
    }

    /**
     * Handle the job team invite "deleted" event.
     *
     * @param  \App\Models\JobTeamInvite  $jobTeamInvite
     * @return void
     */
    public function deleted(JobTeamInvite $jobTeamInvite)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Delete a JobTeamInvite Model',
                'description' => 'Deleted a Job Team Invite',
                'action_id' => $jobTeamInvite->id,
                'action_type' => 'Delete',
                'causee_id' => $jobTeamInvite->job_id,
                'causer_id' => auth()->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the job team invite "restored" event.
     *
     * @param  \App\Models\JobTeamInvite  $jobTeamInvite
     * @return void
     */
    public function restored(JobTeamInvite $jobTeamInvite)
    {
        //
    }

    /**
     * Handle the job team invite "force deleted" event.
     *
     * @param  \App\Models\JobTeamInvite  $jobTeamInvite
     * @return void
     */
    public function forceDeleted(JobTeamInvite $jobTeamInvite)
    {
        //
    }
}

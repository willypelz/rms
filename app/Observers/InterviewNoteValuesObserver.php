<?php

namespace App\Observers;

use App\Models\InterviewNoteValues;

class InterviewNoteValuesObserver
{
    /**
     * Handle the interview note values "created" event.
     *
     * @param  \App\Models\InterviewNoteValues  $interviewNoteValues
     * @return void
     */
    public function created(InterviewNoteValues $interviewNoteValues)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a InterviewNoteValues Model',
                'description' => 'Created an Interview Note value',
                'action_id' => $interviewNoteValues->id,
                'action_type' => 'Create',
                'causee_id' => $interviewNoteValues->job_Applications,
                'causer_id' =>  auth()->user()->id,
                //'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the interview note values "updated" event.
     *
     * @param  \App\Models\InterviewNoteValues  $interviewNoteValues
     * @return void
     */
    public function updated(InterviewNoteValues $interviewNoteValues)
    {
        //
    }

    /**
     * Handle the interview note values "deleted" event.
     *
     * @param  \App\Models\InterviewNoteValues  $interviewNoteValues
     * @return void
     */
    public function deleted(InterviewNoteValues $interviewNoteValues)
    {
        //
    }

    /**
     * Handle the interview note values "restored" event.
     *
     * @param  \App\Models\InterviewNoteValues  $interviewNoteValues
     * @return void
     */
    public function restored(InterviewNoteValues $interviewNoteValues)
    {
        //
    }

    /**
     * Handle the interview note values "force deleted" event.
     *
     * @param  \App\Models\InterviewNoteValues  $interviewNoteValues
     * @return void
     */
    public function forceDeleted(InterviewNoteValues $interviewNoteValues)
    {
        //
    }
}

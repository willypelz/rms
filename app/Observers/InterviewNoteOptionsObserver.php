<?php

namespace App\Observers;

use App\Models\InterviewNoteOptions;

class InterviewNoteOptionsObserver
{
    /**
     * Handle the interview note options "created" event.
     *
     * @param  \App\Models\InterviewNoteOptions  $interviewNoteOptions
     * @return void
     */
    public function created(InterviewNoteOptions $interviewNoteOptions)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a InterviewNoteOptions Model',
                'description' => 'Created an Interview note options',
                'action_id' => $interviewNoteOptions->id,
                'action_type' => 'Create',
                'causee_id' => $interviewNoteOptions->company_id,
                'causer_id' =>  auth()->user()->id,
                //'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the interview note options "updated" event.
     *
     * @param  \App\Models\InterviewNoteOptions  $interviewNoteOptions
     * @return void
     */
    public function updated(InterviewNoteOptions $interviewNoteOptions)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Updated a InterviewNoteOptions Model',
                'description' => 'Updated an Interview note options',
                'action_id' => $interviewNoteOptions->id,
                'action_type' => 'Update',
                'causee_id' => $interviewNoteOptions->company_id,
                'causer_id' =>  auth()->user()->id,
                //'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the interview note options "deleted" event.
     *
     * @param  \App\Models\InterviewNoteOptions  $interviewNoteOptions
     * @return void
     */
    public function deleted(InterviewNoteOptions $interviewNoteOptions)
    {
        //
    }

    /**
     * Handle the interview note options "restored" event.
     *
     * @param  \App\Models\InterviewNoteOptions  $interviewNoteOptions
     * @return void
     */
    public function restored(InterviewNoteOptions $interviewNoteOptions)
    {
        //
    }

    /**
     * Handle the interview note options "force deleted" event.
     *
     * @param  \App\Models\InterviewNoteOptions  $interviewNoteOptions
     * @return void
     */
    public function forceDeleted(InterviewNoteOptions $interviewNoteOptions)
    {
        //
    }
}

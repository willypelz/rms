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
                'log_name' => 'Created Interview Note Options',
                'description' => 'Created an Interview note options',
                'action_id' => $interviewNoteOptions->id,
                'action_type' => 'App\Models\InterviewNoteOptions',
                'causee_id' => '',
                'causer_id' =>  auth()->user()->id,
                'causer_type' => '',
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
                'log_name' => 'Updated a InterviewNoteOptions',
                'description' => 'Updated an Interview note options',
                'action_id' => $interviewNoteOptions->id,
                'action_type' => 'App\Models\InterviewNoteOptions',
                'causee_id' => '',
                'causer_id' =>  auth()->user()->id,
                'causer_type' => '',
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

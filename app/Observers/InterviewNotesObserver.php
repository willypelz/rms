<?php

namespace App\Observers;

use App\Models\InterviewNotes;

class InterviewNotesObserver
{
    /**
     * Handle the interview notes "created" event.
     *
     * @param  \App\Models\InterviewNotes  $interviewNotes
     * @return void
     */
    public function created(InterviewNotes $interviewNotes)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a Interview Note',
                'description' => 'Created a new Interview notes',
                'action_id' => $interviewNotes->id,
                'action_type' => 'App\Models\InterviewNotes',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the interview notes "updated" event.
     *
     * @param  \App\Models\InterviewNotes  $interviewNotes
     * @return void
     */
    public function updated(InterviewNotes $interviewNotes)
    {
        //
    }

    /**
     * Handle the interview notes "deleted" event.
     *
     * @param  \App\Models\InterviewNotes  $interviewNotes
     * @return void
     */
    public function deleted(InterviewNotes $interviewNotes)
    {
        //
    }

    /**
     * Handle the interview notes "restored" event.
     *
     * @param  \App\Models\InterviewNotes  $interviewNotes
     * @return void
     */
    public function restored(InterviewNotes $interviewNotes)
    {
        //
    }

    /**
     * Handle the interview notes "force deleted" event.
     *
     * @param  \App\Models\InterviewNotes  $interviewNotes
     * @return void
     */
    public function forceDeleted(InterviewNotes $interviewNotes)
    {
        //
    }
}

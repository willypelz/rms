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
                'log_name' => 'Created a InterviewNoteValues',
                'description' => 'Created an Interview Note',
                'action_id' => $interviewNoteValues->id,
                'action_type' => 'App\Models\InterviewNoteValues',
                'causee_id' => '',
                'causer_id' =>  auth()->user()->id,
                'causer_type' => 'admin',
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

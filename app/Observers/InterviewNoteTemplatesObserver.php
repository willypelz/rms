<?php

namespace App\Observers;

use App\Models\InterviewNoteTemplates;

class InterviewNoteTemplatesObserver
{
    /**
     * Handle the interview note templates "created" event.
     *
     * @param  \App\Models\InterviewNoteTemplates  $interviewNoteTemplates
     * @return void
     */
    public function created(InterviewNoteTemplates $interviewNoteTemplates)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created Interview Note Templates',
                'description' => 'Created a new Interview notes',
                'action_id' => $interviewNoteTemplates->id,
                'action_type' => 'App\Models\InterviewNoteTemplates',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the interview note templates "updated" event.
     *
     * @param  \App\Models\InterviewNoteTemplates  $interviewNoteTemplates
     * @return void
     */
    public function updated(InterviewNoteTemplates $interviewNoteTemplates)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Updated a InterviewNoteTemplates',
                'description' => 'Updated a new Interview notes',
                'action_id' => $interviewNoteTemplates->id,
                'action_type' => 'App\Models\InterviewNoteTemplates',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the interview note templates "deleted" event.
     *
     * @param  \App\Models\InterviewNoteTemplates  $interviewNoteTemplates
     * @return void
     */
    public function deleted(InterviewNoteTemplates $interviewNoteTemplates)
    {
        //
    }

    /**
     * Handle the interview note templates "restored" event.
     *
     * @param  \App\Models\InterviewNoteTemplates  $interviewNoteTemplates
     * @return void
     */
    public function restored(InterviewNoteTemplates $interviewNoteTemplates)
    {
        //
    }

    /**
     * Handle the interview note templates "force deleted" event.
     *
     * @param  \App\Models\InterviewNoteTemplates  $interviewNoteTemplates
     * @return void
     */
    public function forceDeleted(InterviewNoteTemplates $interviewNoteTemplates)
    {
        //
    }
}

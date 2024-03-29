<?php

namespace App\Observers;

use App\Models\Message;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        //
        if(auth()->check()){
    
            $param = [
                'log_name' => 'Admin sent a message ',
                'description' => isset($message->job_application->candidate) ? 'Message was sent to '.$message->job_application->candidate->getNameAttribute() : 'Message was sent to Candidate',
                'action_id' => $message->id,
                'action_type' => 'App\Models\Message',
                'causee_id' => isset($message->job_application->candidate) ? $message->job_application->candidate_id : null,
                'causer_id' => auth()->user()->id,
                'properties' => '',
            ];
            logAction($param);
           
        }
        
        if(auth()->guard('candidate')->check()){
            $param = [
               'log_name' => 'Applicant sent a message',
               'description' => 'Message was sent from '.auth()->guard('candidate')->user()->getNameAttribute(),
               'action_id' => $message->id,
               'action_type' => 'App\Models\Message',
               'causee_id' =>  null,
               'causer_id' => auth()->guard('candidate')->id(),
               'properties' => '',
           ];
           logAction($param);  
       }
    }

    /**
     * Handle the message "updated" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function updated(Message $message)
    {
        //
    }

    /**
     * Handle the message "deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function deleted(Message $message)
    {
        //
    }

    /**
     * Handle the message "restored" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the message "force deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}

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
                'log_name' => 'Create a Message Model',
                'description' => $message->description,
                'action_id' => $message->id,
                'action_type' => 'App\Models\Message',
                'causee_id' => $message->user_id ? auth()->user()->id : auth()->guard('candidate')->user()->id ,
                'causer_id' => auth()->user()->id,
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

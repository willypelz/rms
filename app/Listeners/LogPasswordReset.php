<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPasswordReset
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Illuminate\Auth\Events\PasswordReset  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        //
    
        $user = $event->user;

        $name = $user->first_name.' '.$user->last_name;
        
        $log_action = [
            'log_name' => "Password Reset",
            'description' => "Admin". $name . " reset their password ",
            'action_id' => $user->id,
            'action_type' => 'App\Users',
            'causee_id' => $user->id->id,
            'causer_id' => $user->id,
            'causer_type' => 'admin',
            'properties'=> ''
        ];
        logAction($log_action);
          
        

    }
}

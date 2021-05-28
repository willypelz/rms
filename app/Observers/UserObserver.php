<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a User Model',
                'description' => 'created a new user'.''.auth()->user()->name,
                'action_id' => $user->id,
                'action_type' => 'Create',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Updated a User Model',
                'description' => 'update on the user'.''.$auth()->user()->name,
                'action_id' => $user->id,
                'action_type' => 'App\User',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Delete a User',
                'description' => 'Deleted user'.''.auth()->user()->name,
                'action_id' => $user->id,
                'action_type' => 'App\User',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}

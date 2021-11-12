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
            if(!isset($user->client_id)){
                User::find($user->id)->update(['client_id' => request()->clientId]);
            }

            $param = [
                'log_name' => 'Created User',
                'description' => 'created a new user'.' '.auth()->user()->name,
                'action_id' => $user->id,
                'action_type' => 'App\User',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
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
            if(!isset($user->client_id)){
                User::find($user->id)->update(['client_id' => request()->clientId]);
            }
            
            $param = [
                'log_name' => 'Updated a User',
                'description' => 'update on the user'.' '.auth()->user()->name,
                'action_id' => $user->id,
                'action_type' => 'App\User',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
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
                'causer_type' => 'admin',
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

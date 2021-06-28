<?php

namespace App\Observers;

use App\Models\Role;


class RoleObserver
{
    /**
     * Handle the role "created" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created Role',
                'description' => 'created'.' '.request()->name.' '.'role',
                'action_id' => $role->id,
                'action_type' => 'App\Models\Role',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Updated Role',
                'description' => 'updated the role to'.' '.request()->name.' '.'role',
                'action_id' => $role->id,
                'action_type' => 'App\Models\Role',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
                'properties'=> '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        //
    }

    /**
     * Handle the role "restored" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the role "force deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Models\Specialization;

class SpecializationObserver
{
    /**
     * Handle the specialization "created" event.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return void
     */
    public function created(Specialization $specialization)
    {
        // 
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a Specialization',
                'description' => 'Created specialization'.' '.request()->name,
                'action_id' => $specialization->id,
                'action_type' => 'App\Models\Specialization',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
        
            logAction($param);
           
        }
    }

    /**
     * Handle the specialization "updated" event.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return void
     */
    public function updated(Specialization $specialization)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Update a Specialization ',
                'description' => 'Updated specialization'.' '.request()->name,
                'action_id' => $specialization->id,
                'action_type' => 'App\Models\Specialization',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the specialization "deleted" event.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return void
     */
    public function deleted(Specialization $specialization)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Delete a Specialization Model',
                'description' => 'Delete specialization'.' '.$specialization->name,
                'action_id' => $specialization->id,
                'action_type' => 'App\Models\Specialization',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the specialization "restored" event.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return void
     */
    public function restored(Specialization $specialization)
    {
        //
    }

    /**
     * Handle the specialization "force deleted" event.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return void
     */
    public function forceDeleted(Specialization $specialization)
    {
        //
    }
}

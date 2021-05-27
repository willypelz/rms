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
                'log_name' => 'Create a Specialization Model',
                'description' => 'Created specialization'.' '.request()->name,
                'action_id' => $specialization->id,
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
                'log_name' => 'Update a Company Model',
                'description' => 'Updated specialization'.' '.request()->name,
                'action_id' => $specialization->id,
                'action_type' => 'Update',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
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
                'action_type' => 'Delete',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
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

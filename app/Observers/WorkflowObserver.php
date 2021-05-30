<?php

namespace App\Observers;

use App\Models\Workflow;

class WorkflowObserver
{
    /**
     * Handle the workflow "created" event.
     *
     * @param  \App\Models\Workflow  $workflow
     * @return void
     */
    public function created(Workflow $workflow)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a Workflow Model',
                'description' => 'created a workflow',
                'action_id' => $workflow->id,
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
     * Handle the workflow "updated" event.
     *
     * @param  \App\Models\Workflow  $workflow
     * @return void
     */
    public function updated(Workflow $workflow)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Updated a Workflow Model',
                'description' => 'updated the workflow',
                'action_id' => $workflow->id,
                'action_type' => 'App\Models\Workflow',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the workflow "deleted" event.
     *
     * @param  \App\Models\Workflow  $workflow
     * @return void
     */
    public function deleted(Workflow $workflow)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Deleted a Workflow',
                'description' => 'Deleted the workflow',
                'action_id' => $workflow->id,
                'action_type' => 'App\Models\Workflow',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the workflow "restored" event.
     *
     * @param  \App\Models\Workflow  $workflow
     * @return void
     */
    public function restored(Workflow $workflow)
    {
        //
    }

    /**
     * Handle the workflow "force deleted" event.
     *
     * @param  \App\Models\Workflow  $workflow
     * @return void
     */
    public function forceDeleted(Workflow $workflow)
    {
        //
    }
}

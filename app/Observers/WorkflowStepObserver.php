<?php

namespace App\Observers;

use App\Models\WorkflowStep;

class WorkflowStepObserver
{
    /**
     * Handle the workflow step "created" event.
     *
     * @param  \App\Models\WorkflowStep  $workflowStep
     * @return void
     */
    public function created(WorkflowStep $workflowStep)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a Workflow Model',
                'description' => 'created the following',
                'action_id' => $workflowStep->id,
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
     * Handle the workflow step "updated" event.
     *
     * @param  \App\Models\WorkflowStep  $workflowStep
     * @return void
     */
    public function updated(WorkflowStep $workflowStep)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a Workflow Model',
                'description' => 'created the following',
                'action_id' => '',
                'action_type' => 'Create',
                'causee_id' => auth->user()->id,
                'causer_id' => Auth::user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the workflow step "deleted" event.
     *
     * @param  \App\Models\WorkflowStep  $workflowStep
     * @return void
     */
    public function deleted(WorkflowStep $workflowStep)
    {
        //
    }

    /**
     * Handle the workflow step "restored" event.
     *
     * @param  \App\Models\WorkflowStep  $workflowStep
     * @return void
     */
    public function restored(WorkflowStep $workflowStep)
    {
        //
    }

    /**
     * Handle the workflow step "force deleted" event.
     *
     * @param  \App\Models\WorkflowStep  $workflowStep
     * @return void
     */
    public function forceDeleted(WorkflowStep $workflowStep)
    {
        //
    }
}

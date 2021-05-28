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
                'log_name' => 'Create a WorkflowStep',
                'description' => 'created a new workflowstep',
                'action_id' => $workflowStep->id,
                'action_type' => 'App\Models\WorkflowStep',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'Admin',
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
                'log_name' => 'Update the WorkflowStep',
                'description' => 'updated the WorkflowStep',
                'action_id' => $workflowStep->id,
                'action_type' => 'App\Models\WorkflowStep',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'Admin',
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

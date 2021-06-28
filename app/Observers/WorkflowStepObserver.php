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
            if(request()->name)
            $param = [
                'log_name' => 'Created a Workflow Step',
                'description' => 'Added a workflow step for '.$workflowStep->workflow->name.' Step '.$workflowStep->order,
                'action_id' => $workflowStep->id,
                'action_type' => 'App\Models\WorkflowStep',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'Admin',
                'properties' => '',
            ];
            else
            $param = [
                'log_name' => 'Created a Workflow Step',
                'description' => 'Added a workflow step for '.$workflowStep->workflow->name.'Step 1 & 2',
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
            $old = $workflowStep->getOriginal('name');
            if($workflowStep->isDirty('name'))
            $param = [
                'log_name' => 'Updated WorkflowStep',
                'description' => 'Updated the WorkflowStep'.' '.$old.' to '.request()->name.' for '.$workflowStep->workflow->name.'' ,
                'action_id' => $workflowStep->id,
                'action_type' => 'App\Models\WorkflowStep',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'Admin',
                'properties' => '',
            ];
            else
            $param = [
                'log_name' => 'Updated WorkflowStep',
                'description' => 'Updated the WorkflowStep'.' '.$workflowStep->name.' for '.$workflowStep->workflow->name.'' ,
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

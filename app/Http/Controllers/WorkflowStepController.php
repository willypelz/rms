<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Workflow;
use Illuminate\Http\Request;

class WorkflowStepController extends Controller
{
    public function create(Request $request, $id)
    {
        if (!$workflow = Workflow::with([
            'workflowSteps' => function ($q) {
                return $q->orderBy('order', 'asc');
            }
        ])->find($id)) {
            return redirect()->route('workflow');
        }

        $currentCompanyUsers = Company::with('users')->find(get_current_company()->id)->users;

        return view('workflow.step.create')
            ->with(compact([
                'workflow',
                'currentCompanyUsers'
            ]));
    }

    public function store(Request $request, $id)
    {
        if (!$workflow = Workflow::with([
            'workflowSteps' => function ($q) {
                return $q->orderBy('order', 'asc');
            }
        ])->find($id)) {
            return redirect()->route('workflow');
        }

        $workflowLastStep = $workflow->workflowSteps->last();

        $this->validate($request, [
            'name' => 'required',
            // 'order' => 'required|integer|min:1', // Order default to last +1, disable user ability to set order
            'type' => 'required',
            'approval_users' => 'required_if:requires_approval,1',
        ]);

        if ($newWorkflowStep = $workflow->workflowSteps()->create($request->all() + [
                'slug' => $request->input('name'),
                'order' => $workflowLastStep->order + 1,
            ])) {

            // attach users that can approval steps
            if ($approval_users = $request->input('approval_users')) {
                $newWorkflowStep->approvals()
                    ->attach($approval_users);
            }

            return redirect()
                ->back()
                ->with('success', 'Step added successfully');
        }

        return redirect()
            ->back()
            ->with('error', 'Can not step to Workflow, try again!!');
    }
}

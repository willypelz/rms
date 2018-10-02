<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Workflow;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;

class WorkflowStepController extends Controller
{
    public function create(Request $request, $id)
    {
        if (!$workflow = Workflow::with([
            'workflowSteps' => function ($q) {
                return $q->orderBy('rank', 'asc');
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
        if (!$workflow = Workflow::with('workflowSteps')->find($id)) {
            return redirect()->route('workflow');
        }

        $this->validate($request, [
            'name' => 'required',
            'rank' => 'required|integer',
        ]);

        if ($newWorkflowStep = $workflow->workflowSteps()->create($request->all())) {

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

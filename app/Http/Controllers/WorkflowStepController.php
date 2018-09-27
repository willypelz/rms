<?php

namespace App\Http\Controllers;

use App\Models\Workflow;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;

use App\Http\Requests;

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

        return view('workflow.step.create')
            ->with([
                'workflow' => $workflow,
            ]);
    }

    public function store(Request $request, $id)
    {
        if (!$workflow = Workflow::find($id)) {
            return redirect()->route('workflow');
        }

        $this->validate($request, [
            'name' => 'required',
            'rank' => 'required|integer',
        ]);

        if ($workflow->workflowSteps()->create($request->all())) {
            return redirect()
                ->back()
                ->with('success', 'Step added successfully');
        }

        return redirect()
            ->back()
            ->with('error', 'Can not step to Workflow, try again!!');
    }
}

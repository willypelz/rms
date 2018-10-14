<?php

namespace App\Http\Controllers;

use App\Models\WorkflowStep;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function edit(Request $request, $id)
    {
        if (!$workflowStep = WorkflowStep::find($id)) {
            return redirect()->back();
        }

        return view('workflow.step.edit')
            ->with('workflowStep', $workflowStep);
    }

    public function update(Request $request, $id)
    {
        if (!$workflowStep = WorkflowStep::with('workflow')->find($id)) {
            return redirect()->route('workflow');
        }

        $this->validate($request, [
            'name' => 'required',
            'order' => 'required|integer',
        ]);

        if ($workflowStep->update($request->all() + ['slug' => $request->name])) {
            return redirect()
                ->route('workflow-steps-add', ['id' => $workflowStep->workflow->id])
                ->with('success', 'Step updated successfully');
        }

        return redirect()
            ->back()
            ->with('error', 'Can not update Step, try again!!');
    }

    public function destroy(Request $request, $id)
    {
        if (!$workflowStep = WorkflowStep::with('workflow')->find($id)) {
            return redirect()->route('workflow');
        }

        if ($workflowStep->delete()) {
            return redirect()
                ->route('workflow-steps-add', ['id' => $workflowStep->workflow->id])
                ->with('success', 'Step deleted successfully');
        }

        return redirect()
            ->back()
            ->with('error', 'Can not delete Step, try again!!');
    }
}

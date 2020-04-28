<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function edit(Request $request, $id)
    {
        if (!$workflowStep = WorkflowStep::with('approvals')->find($id)) {
            return redirect()->back();
        }

        $step_approvals = $workflowStep->approvals->pluck('id');
        $currentCompanyUsers = Company::with('users')->find(get_current_company()->id)->users;

        return view('workflow.step.edit', compact('currentCompanyUsers', 'step_approvals', 'workflowStep'));
    }

    public function update(Request $request, $id)
    {
        if (!$workflowStep = WorkflowStep::with('workflow')->find($id)) {
            return redirect()->route('workflow');
        }

        $this->validate($request, [
            'name' => 'required',
            // 'order' => 'required|integer', // Disable order modification on update
            'type' => 'required',
            'approval_users' => 'required_if:requires_approval,1',
        ]);

        // dd($request->all(), $approval_users);
        if($request->message_to_applicant && empty($request->message_template)){
            return redirect()->back()->withInput()->with('error', 'Message Template is Empty');
        }

        if ($workflowStep->update($request->all() + ['slug' => $request->name])) {

            $workflowStep->refresh();
             // attach users that can approval steps
            // attach users that can approval steps
            if ($approval_users = $request->input('approval_users')) {
                $workflowStep->approvals()
                    ->sync($approval_users);
            }

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

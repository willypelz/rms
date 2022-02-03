<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class StepController extends Controller
{
    public function edit(Request $request, $id)
    {
        if (!$workflowStep = WorkflowStep::with('approvals')->find($id)) {
            return redirect()->back();
        }

        $step_approvals = $workflowStep->approvals->pluck('id');
        $currentCompanyUsers = Company::with('users')->find(get_current_company()->id)->users;

        mixPanelRecord("workflow Step edit started (Admin)", auth()->user());
        return view('workflow.step.edit', compact('currentCompanyUsers', 'step_approvals', 'workflowStep'));
    }

    public function update(Request $request, $id)
    {
        if (!$workflowStep = WorkflowStep::with('workflow')->find($id)) {
            mixPanelRecord("workflow Step update Failed cause it is in use (Admin)", auth()->user());
            return redirect()->route('workflow');
        }

        $this->validate($request, [
            'name' => array(
                'required',
                'regex:/(^([a-zA-Z ]+)(\d+)?$)/u'
            ),
            // 'order' => 'required|integer', // Disable order modification on update
            'type' => 'required',
            'approval_users' => 'required_if:requires_approval,1',
        ],
        $message = [
            'name.regex' => 'Special characters are not allowed'
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
            mixPanelRecord("work flow steps updated Successful (Admin)", auth()->user());
            return redirect()
                ->route('workflow-steps-add', ['id' => $workflowStep->workflow->id])
                ->with('success', 'Step updated successfully');
        }
        mixPanelRecord("work flow steps update Failed ()", auth()->user());
        return redirect()
            ->back()
            ->with('error', 'Can not update Step, try again!!');
    }

    public function destroy(Request $request, $id)
    {
        $workflowStep = WorkflowStep::with('workflow')->find($id);
        if (!$workflowStep) {
            mixPanelRecord("workflow Step Detele Failed cause it is in use (Admin)", auth()->user());
            return redirect()->route('workflow');
        }
        $status = JobApplication::where('status',$workflowStep->slug)->count();
        
        if ($status) {
            return redirect()
                ->route('workflow-steps-add', ['id' => $workflowStep->workflow->id])
                ->with('error', 'Cannot delete a step an applicant is attached to');
        }

        if ($workflowStep->delete()) {
            mixPanelRecord("workflow Step Detele Successful (Admin)", auth()->user());
            return redirect()
                ->route('workflow-steps-add', ['id' => $workflowStep->workflow->id])
                ->with('success', 'Step deleted successfully');
        }
        mixPanelRecord("workflow Step Detele Failed (Admin)", auth()->user());
        return redirect()
            ->back()
            ->with('error', 'Can not delete Step, try again!!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Workflow;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    public function index(Request $request)
    {
        $workflows = Workflow::whereCompanyId(get_current_company()->id)
            ->with('jobs')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('workflow.list', [
            'workflows' => $workflows
        ]);
    }


    public function getSteps($id)
    {
        
        $workflow = Workflow::with('workflowSteps')->find($id);

        if($workflow->workflowSteps){
            $html = '';

            $lastStep = $workflow->workflowSteps->last();

            foreach($workflow->workflowSteps as $key => $step){
                if($lastStep->id != $step->id)
                    $html .= $step->name.' -> ';
                else
                    $html .= $step->name;
            }
                
                return $html;
        }else
            return 'This workflow has no step.';
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        if ($workflow = Workflow::create($request->all() + ['company_id' => get_current_company()->id])) {
            $msg = '';
            // Create default readonly step
            if ($workflow->workflowSteps()->createMany([
                [
                    'name' => 'All',
                    'slug' => 'all',
                    'order' => '1',
                    'type' => 'normal',
                    'is_readonly' => true,
                    'description' => 'List of all the applicants for this job.',
                ],
                [
                    'name' => 'Pending',
                    'slug' => 'pending',
                    'order' => '2',
                    'type' => 'normal',
                    'is_readonly' => true,
                    'description' => 'All applicants are listed here until at least a recruitment action is taken.',
                ],
            ])) {
                $msg = 'Workflow created successfully';
            } else {
                $msg = 'Error creating default Workflow Steps, while Workflow created successfully';
            }

            return redirect()
                ->back()
                ->with('success', $msg);
        }

        return redirect()
            ->back()
            ->with('error', 'Can not create Workflow, try again!!');
    }

    public function editView(Request $request, $id)
    {
        if (!$workflow = Workflow::find($id)) {
            return redirect()->route('workflow');
        }

        return view('workflow.edit')
            ->with('workflow', $workflow);
    }

    public function update(Request $request, $id)
    {
        if (!$workflow = Workflow::find($id)) {
            return redirect()->route('workflow');
        }

        $this->validate($request, [
            'name' => 'required',
        ]);

        if ($workflow->update($request->all())) {

            return redirect()->route('workflow')
                ->with('success', 'Workflow updated successfully');
        }

        return redirect()
            ->back()
            ->with('error', 'Can not update Workflow, try again!!');
    }

    public function destroy(Request $request, $id)
    {
        if (!$workflow = Workflow::find($id)) {
            return redirect()->route('workflow');
        }

        if ($workflow->delete()) {
            return redirect()
                ->back()
                ->with('success', 'Workflow deleted successfully');
        }

        return redirect()
            ->back()
            ->with('error', 'Can not delete Workflow, try again!!');
    }
}

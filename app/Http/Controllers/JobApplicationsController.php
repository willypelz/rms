<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\JobApplication;
use App\Models\Job;
use App\Libraries\Solr;

class JobApplicationsController extends Controller
{
    private $search_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'post_date+desc', 'grouped'=>FALSE ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Profile($appl_id){

    	$appl = JobApplication::with('job', 'cv')->find($appl_id);

    	$nav_type = 'profile';

    	// dd($appl->toArray());

    	return view('applicant.profile', compact('appl', 'nav_type'));

    }


    public function Messages($appl_id){

    	$appl = JobApplication::with('job', 'cv')->find($appl_id);

    	$nav_type = 'profile';

    	// dd($appl->toArray());

    	return view('applicant.messages', compact('appl', 'nav_type'));

    }

    public function viewApplicants( Request $request )
    {
        $job = Job::find($request->jobID);
        $active_tab = 'candidates';

        $result = Solr::get_applicants($this->search_params, $request->jobID);
        $application_statuses = get_application_statuses( $result['facet_counts']['facet_fields']['application_status'] );

        return view('job.board.candidates', compact('job', 'active_tab','result','application_statuses'));
    }


}

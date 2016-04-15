<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\JobApplication;

class JobApplicationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function assess($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'assess';
        
        return view('applicant.assess', compact('appl', 'nav_type'));
    }

    public function activities($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'activities';
        
        return view('applicant.activities', compact('appl', 'nav_type'));
    }

    public function medicals($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'medicals';
        
        return view('applicant.medicals', compact('appl', 'nav_type'));
    }

    public function notes($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'notes';
        
        return view('applicant.notes', compact('appl', 'nav_type'));
    }

    public function checks($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'checks';
        
        return view('applicant.checks', compact('appl', 'nav_type'));
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

}

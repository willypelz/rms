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


    public function Profile($appl_id){

    	$appl = JobApplication::with('job', 'cv')->find($appl_id);

    	// dd($appl->toArray());

    	return view('applicant.profile', compact('appl'));

    }


    public function Messages($appl_id){

    	$appl = JobApplication::with('job', 'cv')->find($appl_id);

    	// dd($appl->toArray());

    	return view('applicant.messages', compact('appl'));

    }

}

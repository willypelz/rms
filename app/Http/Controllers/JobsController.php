<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\JobBoard;
use App\Models\Job;
use App\Models\Company;
use App\User;
use Validator;
use Cart;
use Session;
use Auth;

class JobsController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function PostJob(Request $request)
    {   

        $qualifications = qualifications();

        $user = Auth::user();
        $d = User::with('companies')->where('id', $user->id)->first();
        $company = ($d->companies[0]);
        // dd('hellp');
        // dd($qua);
        $job_boards = JobBoard::where('type', 'free')->get()->toArray();
        $c = (count($job_boards) / 2);
        $t = array_chunk($job_boards, $c);
        $board1 = $t[0];
        $board2 = $t[1];
        foreach ($job_boards as $s) {
            $bds[] = ($s['id']);
        }

        // dd($job_bards);
        if ($request->isMethod('post')) {

            $data = [
                'job_title' => $request->job_title,
                'job_location' => $request->job_location,
                'job_description' => $request->job_description,
                'requirement' => $request->requirement,
                'job_type' => $request->job_type,
                'salary' => $request->salary,
                'qualification' => $request->qualification
            ];

            $validator = Validator::make( $data, [
                        'job_title' => 'required',
                        'job_location' => 'required',
                        'job_description' => 'required',
                        'requirement' => 'required',
                        'job_type' => 'required',
                        'qualification' => 'required'
                ]);

            if($validator->fails()){
                       return redirect()->back()
                          ->withErrors($validator)
                          ->withInput();
                    }else{
                        // dd('Success');
                        $pickd_boards = $request->boards;

                        $job = Job::FirstorCreate([
                                'title' => $request->job_title,
                                'location' => $request->job_location,
                                'details' => $request->job_description,
                                'experience' => $request->requirement,
                                'qualification' => $request->qualification,
                                'job_type' => $request->job_type,
                                'published' => 1,
                                'company_id' => $company->id
                        ]);

                        foreach ($pickd_boards as $p) {
                            if(in_array($p, $bds))
                                $job->boards()->attach($p);
                        }

                        $job_url = $job->id.'/'.str_slug($request->job_title);
                       
                        Job::where('id', $job->id)
                          ->update(['job_url' => $job_url]);

                        // dd($job_url);
                    }
                        
            Session::flash('flash_message', 'You Job has been successfully posted on your selected free advertising boards!');
            return redirect()->route('advertise', [$job->id]);

        }

        // dd('here');
        return view('job.create', compact('qualifications', 'board1', 'board2'));
    }

    public function Advertise($jobid){

        $job_boards = JobBoard::where('type', 'paid')->get()->toArray();
        $c = (count($job_boards) / 2);
        $t = array_chunk($job_boards, $c);
        $board1 = $t[0];
        $board2 = $t[1];
        foreach ($job_boards as $s) {
            $bds[] = ($s['id']);
        }

        $price = 0;
        $cart = Cart::instance('JobBoard')->content();
        $count = Cart::instance('JobBoard')->count();
        foreach ($cart as $k) {
                $ids[] = ($k->id);
                $price += $k->price; 
        }
        // dd($price);
            if(empty($ids))
                $ids = null;


        return view('job.advertise', compact('board1', 'board2', 'ids', 'cart', 'count', 'price', 'jobid'));
    }

    public function Share($id){

        $user = Auth::user();
        $d = User::with('companies')->where('id', $user->id)->first();
        $company = ($d->companies[0]);

        $job = Job::find($id)->first();

        return view ('job.share', compact('company', 'job'));
    }

    public function JobView($jobid, $slug, Request $request)
    {
        $job = Job::find($jobid);
        return view('job.job-details', compact('job'));
    }
    
    public function JobList(Request $request){

        $user = Auth::user();
        $comp = User::with('companies.jobs')->where('id', $user->id)->get();
        $jobs = ($comp[0]->companies[0]->jobs);

        return view('job.job-list', compact('jobs'));
    }

    public function JobBoard($id, Request $request){

        $job = Job::find($id);
        $active_tab = 'promote';
        return view('job.board.home', compact('job', 'active_tab'));
    }

    public function JobTeam($id, Request $request){
        
        $user = User::with('companies')->find(Auth::user()->id);
        $comp_id = ($user->companies[0]->id);

        $users  = Company::with('users')->find($comp_id);
        
        $job = Job::find($id);
        $active_tab = 'team';

        return view('job.board.team', compact('job', 'active_tab', 'users'));
    }

    public function JobActivities($id, Request $request){
         $job = Job::find($id);
        $active_tab = 'activities';

        return view('job.board.activities', compact('job', 'active_tab'));
    }

    public function JobCandidates($id, Request $request){
         $job = Job::find($id);
        $active_tab = 'candidates';


        return view('job.board.candidates', compact('job', 'active_tab'));
    }

    public function JobMatching($id, Request $request){
         $job = Job::find($id);
        $active_tab = 'matching';


        return view('job.board.matching', compact('job', 'active_tab'));
    }


    public function saveCVPreview($cv)
    {
        
    }

    public function Ajax(Request $request){

        $user = User::find($request->user_id);

        return view('job.ajax-team-edit', compact('user'));
    }

}

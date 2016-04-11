<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\JobBoard;
use App\Models\Job;
use App\Models\JobApplication;
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

    public function jobApply($jobID, $slug, Request $request){

        $job = Job::where('id', $jobID)->first();

        $qualifications = [

                'MPhil / PhD',
                'MBA / MSc',
                'MBBS',
                'B.Sc',
                'HND',
                'OND',
                'N.C.E',
                'Diploma',
                'High School (S.S.C.E)',
                'Vocational',
                'Others'

            ];

        $states = [
                'Lagos',
                'Abia',
                'Abuja',
                'Adamawa',
                'Akwa Ibom',
                'Anambra',
                'Bauchi',
                'Bayelsa',
                'Benue',
                'Borno',
                'Cross river',
                'Delta',
                'Edo',
                'Ebonyi',
                'Ekiti',
                'Enugu',
                'Gombe',
                'Imo',
                'Jigawa',
                'Kaduna',
                'Kano',
                'Katsina',
                'Kebbi',
                'Kogi',
                'Kwara',
                'Niger',
                'Ogun',
                'Ondo',
                'Osun',
                'Oyo',
                'Nassarawa',
                'Plateau',
                'Rivers',
                'Sokoto',
                'Taraba',
                'Yobe',
                'Zamfara'
            ];    


        if ($request->isMethod('post')) {

            $data = $request->all();

            if ($request->hasFile('cv_file')) {

                $filename = str_slug($request->email).'_'.$request->file('cv_file')->getClientOriginalName();
                $destinationPath = env('UPLOAD_PATH');
                $request->file('cv_file')->move($destinationPath, $filename);

                $data['cv_file'] = $filename;

                // dd($data);
            }    



            
            $data['job_id'] = $job->id;
            unset($data['_token']);

            $data['date_of_birth'] = date('Y-m-d', strtotime($data['date_of_birth']));

            if($data['willing_to_relocate'] == 'yes')
                $data['willing_to_relocate'] = true;

            $data['state_of_origin'] = $states[$data['state_of_origin']];
            $data['location'] = $states[$data['location']];
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            // dd($data);

            JobApplication::insert($data);

            // return redirect('/applied/'.$slug);
            // dd($request->all());



        }

        
        return view('job.job-apply', compact('job', 'qualifications', 'states'));
    }

    public function Ajax(Request $request){

        $user = User::find($request->user_id);

        return view('job.ajax-team-edit', compact('user'));

    }

}

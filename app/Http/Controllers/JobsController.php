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
use Mail;

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

        $locations = locations();
        // dd($locations);


        $user = Auth::user();
        $d = User::with('companies')->where('id', $user->id)->first();
        $company = ($d->companies[0]);
        // dd($company);
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

            // dd($request->request);
            $data = [
                'job_title' => $request->job_title,
                'job_location' => $request->job_location,
                'details' => $request->details,
                'experience' => $request->experience,
                'job_type' => $request->job_type,
                'position' => $request->position,
                'post_date' => $request->post_date,
                'expiry_date' => $request->expiry_date
            ];


            $validator = Validator::make( $data, [
                        'job_title' => 'required',
                        'job_location' => 'required',
                        'details' => 'required',
                        'experience' => 'required',
                        'job_type' => 'required',
                        'position' => 'required',
                        'expiry_date' => 'required'
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
                                'details' => $request->details,
                                'experience' => $request->experience,
                                'job_level' => $request->job_type,
                                'position' => $request->position,
                                'post_date' => $request->post_date,
                                'expiry_date' => $request->expiry_date,
                                'status' => 'ACTIVE',
                                'company_id' => $company->id
                        ]);

                        foreach ($pickd_boards as $p) {
                            if(in_array($p, $bds))
                                $job->boards()->attach($p);
                        }

                        // dd($job_url);
                    }
                        
            Session::flash('flash_message', 'You Job has been successfully posted on your selected free advertising boards!');
            return redirect()->route('advertise', [$job->id]);

        }

        // dd('here');
        return view('job.create', compact('qualifications', 'board1', 'board2', 'locations'));
    }

    public function SaveJob(Request $request){
        dd($request->request);
    }

    public function Advertise($jobid, $slug= null){

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


        return view('job.advertise', compact('board1', 'board2', 'ids', 'cart', 'count', 'price', 'jobid', 'slug'));
    }

    public function Share($id){

        $user = Auth::user();
        $d = User::with('companies')->where('id', $user->id)->first();
        $company = ($d->companies[0]);

        $job = Job::find($id);
        // dd($job);
        return view ('job.share', compact('company', 'job'));
    }

    public function AddCandidates($id){

        return view ('job.add-candidates');
    }

     public function UploadCVfile($id){

    
    }


    public function JobView($company_slug, $jobid, $job_slug, Request $request)
    {
        $company = Company::where('slug', $company_slug)->first();
        $job = Job::where('id', $jobid)->where("company_id",$company->id)->first();

        if(empty($job)){
            // redirect to 404 page
        }


        return view('job.job-details', compact('job', 'company'));
    }
    
    public function JobList(Request $request){

        $user = Auth::user();
        $comp = User::with('companies.jobs')->where('id', $user->id)->get();
        $jobs = ($comp[0]->companies[0]->jobs);
        
        $active = 0;
        $suspended = 0;
        foreach($jobs as $job){
            if ($job->published == 1) {
                $active++;
            }else{
                $suspended++;
            }
        }
       $comp_name = ($comp[0]->companies[0]->name);

        return view('job.job-list', compact('jobs', 'active', 'suspended', 'comp_name'));
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


    public function company($c_url){

        $company = Company::with(['jobs'=>function($query){
                                        $query->where('published', 1);
                                    }])->where('slug', $c_url)->first();


        return view('job.company', compact('company'));

    }
    
    public function Ajax(Request $request){

        $user = User::find($request->user_id);

        return view('job.ajax-team-edit', compact('user'));

    }

    public function EditJob(Request $request, $jobid){

        $job = Job::findOrFail($jobid);
        $locations = locations();
        $qualifications = qualifications();

        if($request->isMethod('post')){
            $job->update($request->all());
        
            return redirect()->route('job-view', ['id' => $job->id, 'slug'=>str_slug($job->title)]);

        }


        return view('job.edit', compact('qualifications', 'job', 'locations'));

    }

    public function JobStatus(Request $request){

        $job = Job::find($request->job_id);
       
        $res = Job::where('id', $request->job_id)
                ->update(['status' => $request->status]);

        if($res)
            echo true;
    }

    public function ReferJob(Request $request){
        // dd($request->request);
        if($request->isMethod('post')){

            $to = explode(',', $request->to);
            $job = Job::find($request->jobid);

             $mail = Mail::queue('emails.cv-sales-invoice', ['job' => $job], function ($m) use($to) {
                    $m->from('hello@app.com', 'Your Application');

                    $m->to($to)->subject('Your Reminder!');
            });

             if($mail){
                echo 'sent';
             }else{
                echo "error sending";
             }

        }
    }

    public function SimplePay(Request $request){
        
        $private_key = 'test_pr_bbe9d51b272e4a718b01d5c8eb7d2c1f';

        // Retrieve data returned in payment gateway callback
        // $token = $_POST["token"];
        $token = $request->token;
        // $transaction_id = $_POST["transaction_id"]; // we don't really need this here, is just an example

        $data = array (
            'token' => $token
        );
        $data_string = json_encode($data); 

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://checkout.simplepay.ng/v1/payments/verify/');
        curl_setopt($ch, CURLOPT_USERPWD, $private_key . ':');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string)                                                                       
        ));       

        $curl_response = curl_exec($ch);
        $curl_response = preg_split("/\r\n\r\n/",$curl_response);
        $response_content = $curl_response[1];
        $json_response = json_decode(chop($response_content), TRUE);

        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($response_code == '200') {
            // even is http status code is 200 we still need to check transaction had issues or not
            if ($json_response['response_code'] == '20000'){
                // header('Location: success.html');
                // dd('Success');
                return $json_response;
            }else{
                // header('Location: failed.html');
                dd('Failed');
            }
        } else {
            // header('Location: failed.html');
            dd('Failed');
        }


    }

    public function SendJob(Request $request){
        // dd($request->request);
            $job = Job::find($request->jobid);
            $to = $request->emails;

            $mail = Mail::queue('emails.cv-sales-invoice', ['job' => $job], function ($m) use($to) {
            $m->from('alerts@insidify.com', 'Your Application');

            $m->to($to)->subject('Job for you');
            });

             if($mail){
                echo 'Email has been sent successfully';
             }else{
                echo "Error sending, please try again in few minutes";
             }

    }

    public function SavetoMailbox(Request $request){
        
        $user = Auth::user();
        $job = Job::find($request->jobid);
        $to = $user->email;

        $mail = Mail::queue('emails.cv-sales-invoice', ['job' => $job], function ($m) use($to) {
        $m->from('alerts@insidify.com', 'Your Application');

        $m->to($to)->subject('Job for you');
        });

         if($mail){
            echo 'Email has been sent successfully';
         }else{
            echo "Error sending, please try again in few minutes";
         }

    }

}

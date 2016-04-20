<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\JobBoard;
use App\Models\Job;
use App\Models\Specialization;
use App\Models\JobActivity;
use App\Models\Cv;
use App\Models\JobApplication;
use App\Models\Company;
use App\User;
use Validator;
use Cart;
use Session;
use Auth;
use Mail;
use Curl;


class JobsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'JobView',
            'company',
            'jobApply',
            'JobApplied',
            'jobApplied',
        ]]);
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
        $specializations = Specialization::get();

        $user = Auth::user();
        $d = User::with('companies')->where('id', $user->id)->first();
        $company = ($d->companies[0]);
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

                $pickd_boards = $request->boards;

           

            $data = [
                'job_title' => $request->job_title,
                'job_location' => $request->job_location,
                'details' => $request->details,
                'job_type' => $request->job_type,
                'position' => $request->position,
                // 'post_date' => $request->post_date,
                'expiry_date' => $request->expiry_date
            ];


            $validator = Validator::make( $data, [
                        'job_title' => 'required',
                        'job_location' => 'required',
                        'details' => 'required',
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
                                'job_type' => $request->job_type,
                                'position' => $request->position,
                                'post_date' => date('Y-m-d'),
                                'expiry_date' => $request->expiry_date,
                                'status' => 'ACTIVE',
                                'company_id' => $company->id
                        ]);

                         $out_boards = array();
                        foreach ($pickd_boards as $p) {
                            if(in_array($p, $bds))
                                $job->boards()->attach($p);
                                $out_boards[] = JobBoard::where('id', $p)->first()->name;
                        }
                        $flash_boards = implode(', ', $out_boards);

                        foreach ($request->specializations as $e) {
                           $job->specializations()->attach($e);
                        }

                    }

                    
                        
            Session::flash('flash_message', 'Congratulations! Your job has been posted on '.$flash_boards.'. You will begin to receive the applications for your jobs on all these job advert platforms on SeamlessHiring soon – no need to open accounts elsewhere.');
            return redirect()->route('advertise', [$job->id]);
        }

        return view('job.create', compact('qualifications', 'specializations', 'board1', 'board2', 'locations'));
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
        return view ('job.share', compact('company', 'job', 'user'));
    }

    public function AddCandidates($jobid = null){

        if(!empty($jobid)){
            $job = Job::find($jobid);
        }

        return view ('job.add-candidates', compact('jobid', 'job'));
    }

     public function UploadCVfile($id){

    
    }


    
    
    public function JobList(Request $request){

        $user = Auth::user();
        $user = User::with('companies.jobs')->where('id', $user->id)->first();
        $jobs = ($user->companies[0]->jobs);
        $company = $user->companies[0];
        
        $active = 0;
        $suspended = 0;
        foreach($jobs as $job){
            if ($job->status == 'ACTIVE') {
                $active++;
            }else{
                $suspended++;
            }
        }
        return view('job.job-list', compact('jobs', 'active', 'suspended', 'company'));
    }

    public function JobPromote($id, Request $request){

        $job = Job::find($id);
        $company = $job->company()->first();

        $active_tab = 'promote';
        return view('job.board.home', compact('job', 'active_tab', 'company'));
    }

    public function JobTeam($id, Request $request){
        
        $user = User::with('companies')->find(Auth::user()->id);
        $comp_id = ($user->companies[0]->id);

        $users  = Company::with('users')->find($comp_id);
        
        $job = Job::find($id);
        $active_tab = 'team';

        return view('job.board.team', compact('job', 'active_tab', 'users'));
    }

    public function ActivityContent(Request $request){
         $content = '<ul class="list-group list-notify">';
        
        if(!empty($request->appl_id)){
            $activities =  JobActivity::with('user', 'application.cv', 'job')->where('job_application_id', $request->appl_id)->orderBy('created_at', 'desc')->take(20)->get();
        }elseif($request->type == 'dashboard'){

          $comp = Auth::user()->companies;
          $comp_id = ($comp[0]->id);

          $jobs = Job::where('company_id', $comp_id)->get(['id'])->toArray();
          $activities = JobActivity::with('user', 'application.cv', 'job')->whereIn('job_id', $jobs)->orderBy('created_at', 'desc')->take(20)->get();
          // dd($activities);

        }else{
            $activities =  JobActivity::with('user', 'application.cv', 'job')->where('job_id', $request->jobid)->orderBy('created_at', 'desc')->take(20)->get();
        }
            // dd($activities);
        foreach ($activities as $ac) {
            $type = $ac->activity_type;

            switch ($type) {

                case "JOB-CREATED":
                     $job = $ac->job;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Job Created</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, h:i A', strtotime($ac->created_at)) .']</small> 
                                      '. $ac->user->name .' Created a new Job <strong>'.$job->title.'</strong>.
                                  </p>
                                </li>';
                     break;
                 case "APPLIED":
                     $applicant = $ac->application->cv;
                     $job = $ac->application->job;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Job Application</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, h:i A', strtotime($ac->created_at)) .']</small> 
                                      '.$applicant->first_name.' '.$applicant->last_name.' applied for <strong>'.$job->title.'</strong>
                                  </p>
                                </li>';
                     break;
                 case "HIRE":
                 $applicant = $ac->application->cv;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-edit fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Application</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, h:i A', strtotime($ac->created_at)) .']</small> 
                                      '.$applicant->first_name.' '.$applicant->last_name.' has been hired.
                                  </p>
                                </li>';
                     break;
                 case "REJECT":
                    $applicant = $ac->application->cv;
                    // dd($ac->to);
                    $content .= '<li role="warning-notifications" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-exclamation fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-danger">REJECT</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, h:i A', strtotime($ac->created_at)) .']</small>
                                      '.$applicant->first_name.' '.$applicant->last_name.' application was rejected by <a href=""> '.$ac->user->name.'</a>
                                  </p>
                                </li>';
                     break;
                 case "COMMENT":
                 $applicant = $ac->application->cv;

                     $content .= '<li role="messaging" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Comment</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, h:i A', strtotime($ac->created_at)) .']
                                      </small> '. $ac->user->name .' said '.$ac->comment.' about <a href="#">'.$applicant->first_name.'</a>
                                  </p>
                                  
                                </li>';
                     break;

                    case "SUSPEND-JOB":
                     $content .= '<li role="messaging" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-ban fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Suspend Job</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, h:i A', strtotime($ac->created_at)) .']</small> 
                                      '. $ac->user->name .' suspended <a href="#">'.$ac->job->title .'</a> job
                                  </p>
                                  
                                </li>';
                     break;

                     case "PUBLISH-JOB":
                     $content .= '<li role="messaging" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-thumbs-o-up fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Publish Job</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, h:i A', strtotime($ac->created_at)) .']</small> 
                                      '. $ac->user->name .' published <a href="#">'.$ac->job->title .'</a> job
                                  </p>
                                  
                                </li>';
                     break;

                     case "ADD-TEAM":
                     $content .= '<li role="messaging" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Team</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, h:i A', strtotime($ac->created_at)) .']</small> 
                                      '. $ac->user->name .' added a new Team member.
                                  </p>
                                  
                                </li>';
                     break;

                 default:
                     $content .= '<li role="messaging" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Not Set -- '.$act->activity_type.'</h5>
                                  <p>
                                     
                                  </p>
                                  
                                </li>';
            }

        }
        // dd($act->toArray());

        $content .= '</ul>';

        return $content;
    }

    public function JobActivities($id, Request $request){
         $job = Job::find($id);
         // dd($job);
        
        $active_tab = 'activities';

        return view('job.board.activities', compact('job', 'active_tab', 'content'));
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

    public function JobView($company_slug, $jobid, $job_slug, Request $request)
    {
        $company = Company::where('slug', $company_slug)->first();
        $job = Job::where('id', $jobid)->where("company_id",$company->id)->first();

        if(empty($job)){
            // redirect to 404 page
        }

        //increment job views


        return view('job.job-details', compact('job', 'company'));
    }



    public function jobApply($jobID, $slug, Request $request){

        $job = Job::with('company')->where('id', $jobID)->first();
        $company = $job->company;
        $specializations = Specialization::get();
        

        if(empty($job)){
            // redirect to 404 page
        }


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

          // dd($request->request);

            $data = $request->all();

            if ($request->hasFile('cv_file')) {

                $filename = time().'_'.str_slug($request->email).'_'.$request->file('cv_file')->getClientOriginalName();
                $destinationPath = env('fileupload').'/CVs';
                // dd($destinationPath);
                $request->file('cv_file')->move($destinationPath, $filename);

                $data['cv_file'] = $filename;

                // dd($data);
            }   

            $data['date_of_birth'] = date('Y-m-d', strtotime($data['date_of_birth']));

            // if($data['willing_to_relocate'] == 'yes')
            //     $data['willing_to_relocate'] = true;

            $data['state_of_origin'] = $states[$data['state_of_origin']];
            $data['location'] = $states[$data['location']];
            $data['created'] = date('Y-m-d H:i:s');
            $data['action_date'] = date('Y-m-d H:i:s');



            //saving cv...  
            $cv = new Cv;
            $cv->first_name = $data['first_name'];
            $cv->last_name = $data['last_name'];
            $cv->headline = $data['cover_note'];
            $cv->email = $data['email'];
            $cv->phone = $data['phone'];
            $cv->gender = $data['gender'];
            $cv->date_of_birth = $data['date_of_birth'];
            $cv->marital_status = $data['marital_status'];
            $cv->state = $data['location'];
            $cv->highest_qualification = $data['highest_qualification'];
            $cv->last_position = $data['last_position'];
            $cv->last_company_worked = $data['last_company_worked'];
            $cv->years_of_experience = $data['years_of_experience'];
            // $cv->willing_to_relocate = $data['willing_to_relocate'];
            $cv->cv_file = $data['cv_file'];
            $cv->save();

            //saving job application...
            $appl = new JobApplication;
            $appl->cover_note = $data['cover_note'];
            $appl->cv_id = $cv->id;
            $appl->job_id = $job->id;
            $appl->status = 'PENDING';
            $appl->created = $data['created'];
            $appl->action_date = $data['action_date'];
            $appl->save();

             foreach ($request->specializations as $e) {
                  $cv->specializations()->attach($e);
              }
            
            // return redirect('jobs/applied/'.$jobID.'/'.$slug);

            return redirect()->route('job-applied', ['jobid' => $jobID, 'slug'=>$slug]);
            // dd($request->all());




        }

        
        return view('job.job-apply', compact('job', 'qualifications', 'states', 'company', 'specializations'));

    }

    public function JobApplied($jobID, $job_slug, Request $request)
    {
        $job = Job::with('company')->where('id', $jobID)->first();
        $company = $job->company;
        

        if(empty($job)){
            // redirect to 404 page
        }

        $response = Curl::to('https://api.insidify.com/articles/get-posts')
                                ->withData(array('limit'=>6))
                                ->post();

        $posts = json_decode($response)->data->posts;


        return view('job.applied', compact('job', 'company', 'posts'));

    }


    public function company($c_url){

        $company = Company::with(['jobs'=>function($query){
                                        $query->where('status', "ACTIVE")->where('expiry_date','>',date('Y-m-d'));
                                    }])->where('slug', $c_url)->first();


        // dd($company);

        return view('job.company', compact('company'));

    }

    public function MyCompany(){

        $user = Auth::user();
        $d = User::with('companies')->where('id', $user->id)->first();
        $company = ($d->companies[0]);

        return redirect('/'.$company->slug);


    }

    public function Preview($job_id){

        $job = Job::with('company')->find($job_id);

        return redirect('/'.$job->company->slug.'/job/'.$job->id.'/'.str_slug($job->title));


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
       // dd($job);
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

    public function DuplicateJob (Request $request){

      $newJob = Job::find($request->job_id)->replicate()->save();
      
      if ($newJob) {
        echo true;
      }
    }

}

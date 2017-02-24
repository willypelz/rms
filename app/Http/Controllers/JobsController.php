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
use App\Models\FormFields;
use App\Models\FormFieldValues;
use App\Models\VideoApplicationOptions;
use App\Models\VideoApplicationValues;
use App\Models\Settings;
use App\Models\TestRequest;
use App\User;
use Validator;
use Cart;
use Session;
use Auth;
use Mail;
use Curl;
use App\Libraries\Solr;
use App\Libraries\Utilities;
use Carbon\Carbon;
use DB;
use Crypt;
use  App\Http\Controllers\CvSalesController;
use File;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use App\Jobs\UploadZipCv;
use Alchemy\Zippy\Zippy;
use Charts;
// use Zipper;

class JobsController extends Controller
{
    private $search_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'application_date+desc', 'grouped'=>FALSE ];

    protected $mailer;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth', ['except' => [
            'JobView',
            'company',
            'jobApply',
            'JobApplied',
            'JobVideoApplication',
            'getEmbed',
            'getEmbedTest'
        ]]);

        $this->mailer = $mailer;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function JobTeamAdd(Request $request)
    {
      # code...
      // dd('helo');
      // dd($request->request);

      $validator = Validator::make($request->all(), [
            'email' => 'required'
        ],[
            'email.required' => 'Email is required'
        ]);

        if ($validator->fails()) {
            echo 'Issue dey';
        }
        else
        {   
          //Create User
             $link = "dashboard";   
            $user = User::where('email', $request->email_to)->first();
            if(empty($user)){
                $user = User::FirstorCreate([              
                  'email' => $request->email,
                  'name' => $request->name
                ]);    

                $link = "password/reset";
            }


            $mail_body = $request->body_mail;
            

            //Add user to company users
            $company = Company::find( get_current_company()->id );
            $company->users()->attach($user->id);

            $job = Job::find($request->job_id);

            //Save Invite Code
            $user->invite_code = str_random(40);
            
            //Send notification mail
            $email_from = ( Auth::user()->email ) ? Auth::user()->email : 'no-reply@insidify.com';
            /*Mail::send('emails.e-exculsively-invited', ['mail_body'=>$mail_body, 'name'=>$user->name, 'job_title'=>$job->title, 'company'=>$company->name, 'link'=>$link ], function($message) use ($user){
                $message->from('support@seamlesshiring.com');
                $message->to($user->email, $user->name);
            });*/ 

            $this->mailer->send('emails.new.exculsively_invited', ['user' => $user, 'job_title'=>$job->title, 'company'=>$company->name, 'link'=> $link], function (Message $m) use ($user) {
                $m->from('support@seamlesshiring.com')->to($user->email)->subject('You have been Exclusively Invited');
            });

            echo 'Saved';
        }

        
      //$comp->users()->attach($user->id);

      
    }

    public function JobTeamDecline()
    {
        
    }
   
    public function PostJob(Request $request)
    {   

        $qualifications = qualifications();
        $locations = locations();
        $specializations = Specialization::get();

        $user = Auth::user();
        $company = get_current_company();
        $job_boards = JobBoard::where('type', 'free')->get()->toArray();
        $c = (count($job_boards) / 2);
        $t = array_chunk($job_boards, $c);
        $board1 = $t[0];
        $board2 = $t[1];
        $urls = [];
        foreach ($job_boards as $s) {
            $bds[] = ($s['id']);
            $urls[ $s['id'] ] = "";
        }

        //Free Job boards urls
        $insidify_url = "";

        // dd($job_bards);
        if ($request->isMethod('post')) {

                $pickd_boards = [ 1 ];
                // dd( $request->all() );
           

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
                        $pickd_boards = [ 1 ];

                        $job_data = [
                                'title' => $request->job_title,
                                'location' => $request->job_location,
                                'details' => $request->details,
                                'job_type' => $request->job_type,
                                'position' => $request->position,
                                'post_date' => date('Y-m-d'),
                                'expiry_date' => $request->expiry_date,
                                'status' => 'ACTIVE',
                                'company_id' => $company->id
                        ];
                        

                        
                        // dd($job_data ,$insidify_url, $bds, $pickd_boards);

                        $job = Job::FirstorCreate($job_data);

                        // $insidify_url = Curl::to("https://insidify.com/ss-post-job")
                        //             ->withData(  [ 'secret' => '1ns1d1fy', 'data' =>  [ 'job' => $job_data, 'specializations' => @$request->specializations, 'company' => get_current_company()->toArray(), 'action_link' => url('job/apply/'.$job->id.'/'.str_slug($job->title) ) ]  ]  )
                        //             // ->asJson()
                        //             ->post();
                        // $urls[1] = $insidify_url;
                        // 
                        $urls[1] = "";
                        // dd( [ 'job' => $job_data, 'specializations' => $request->specializations, 'insidify_url' => $insidify_url, 'company' => get_current_company()->toArray(), 'action_link' => url('job/apply/'.$job->id.'/'.str_slug($job->title) ) ] );

                        //Save job creation to activity
                        save_activities('JOB-CREATED',  $job->id );

                        //save custom fields
                        if( isset($request->custom_names) and $request->custom_names != null )
                        {
                            $custom_data = [];
                            for ($i=0; $i < count( $request->custom_names ); $i++) { 
                                $custom_data[] = [
                                    'name' => $request->custom_names[$i], 
                                    'type' => $request->custom_types[$i], 
                                    'options' => $request->custom_options[$i], 
                                    'job_id' => $job->id,
                                ];
                            }
                            FormFields::insert($custom_data);
                        }
                        

                         $out_boards = array();
                        foreach ($pickd_boards as $p) {
                            if(in_array($p, $bds))
                                $job->boards()->attach($p,  ['url' => $urls[$p]]);
                                $out_boards[] = JobBoard::where('id', $p)->first()->name;
                        }
                        $flash_boards = implode(', ', $out_boards);

                        foreach ($request->specializations as $e) {
                           $job->specializations()->attach($e);
                        }

                    }

                    
                        
            Session::flash('flash_message', 'Congratulations! Your job has been posted on '.$flash_boards.'. You will begin to receive applications from those job boards shortly - <i>this is definite</i>.');
            return redirect()->route('post-success', ['jobID' => $job->id]);
        }

        return view('job.create', compact('qualifications', 'specializations', 'board1', 'board2', 'locations'));
    }


    public function PostSuccess(Request $request){
        $job = Job::find($request->jobID);
        $insidify_url = $request->insidify_url;

        $subscribed_boards = $job->boards()->get()->toArray();

        /*$approved_count = array_filter( array_pluck( $subscribed_boards, 'pivot.url' ), function(){ 

                if(@$subscribed_board['url'] != null && @$subscribed_boards['url'] != '')
                {
                    return true;
                }
                else
                {
                    return false;
                }
         } );*/
        $approved_count =  $pending_count = 0;

        foreach ($subscribed_boards as $key => $board) {

            if($board['pivot']['url'] != '')
            {
                $approved_count++;
            }
            else
            {
                $pending_count++;
            }
        };
        $subscribed_boards_id = array_pluck($subscribed_boards, 'id' );

        // $all_job_boards = JobBoard::where('type', 'free')->get()->toArray();
        $all_job_boards = JobBoard::all()->toArray();


        return view('job.success-old', compact('job','insidify_url','subscribed_boards','approved_count','pending_count','all_job_boards','subscribed_boards_id'));
    }

    public function SaveJob(Request $request){
        dd($request->request);
    }

    public function Advertise($jobid, $slug= null){

        $job_boards = JobBoard::where('type', 'paid')->where('avi', null)->get()->toArray();

        $newspapers = JobBoard::where('type', 'paid')->where('avi', 1)->get();
        // dd($newspapers->toArray());
        // $c = (count($job_boards) / 2);
        // $t = array_chunk($job_boards, $c);
        // $board1 = $t[0];
        // $board2 = $t[1];
        foreach ($job_boards as $s) {
            $bds[] = ($s['id']);
        }

        $price = 0;
        
        $cart = Utilities::getCartContent('job-boards'); 
        $count = Utilities::getBoardCartCount('job-boards'); 

        foreach ($cart as $k) {
                $ids[] = ($k->id);
                $price += $k->price; 
        }
        // dd($price);
            if(empty($ids))
                $ids = null;


        return view('job.advertise', compact('newspapers', 'job_boards', 'ids', 'cart', 'count', 'price', 'jobid', 'slug'));
    }

    public function Share($id){

        $user = Auth::user();
        $company = get_current_company();

        $job = Job::find($id);
        // dd($job);
        return view ('job.share', compact('company', 'job', 'user'));
    }

    public function AddCandidates($jobid = null){

        if(!empty($jobid)){
            $job = Job::find($jobid);
        }

        $myJobs = Job::getMyJobs();
        $myFolders = array_unique( array_pluck( Solr::get_all_my_cvs($this->search_params, null, null)['response']['docs'] ,'cv_source') );

        if(($key = array_search('Direct Application', $myFolders)) !== false) {
            unset($myFolders[$key]);
        }


        return view ('job.add-candidates', compact('jobid', 'job', 'myJobs', 'myFolders'));
    }

     public function UploadCVfile( Request $request ){
        
        

          // $zipper = new Zipper;
        ///Applications/AMPPS/www/seamlesshiring/public_html/
        // dd( Zipper::getFileContent( '\Applications\AMPPS\www\seamlesshiring\public_html\uploads\esimakin-twbs-pagination-1.3.1-2-g4a2f5ff.zip' ) );


        /*array:4 [
          "_token" => "oblmiKczvYoGWh5mhEr5PMIR1SekBtXofdc4qmFF"
          "options" => "upToJob"
          "job" => "90"
          "cv-upload-file" => ""
        ]*/
        //'Image' => 
            $validator = Validator::make($request->all(), [
                'cv-upload-file' => 'required|mimes:zip,pdf,doc,docx,txt,rtf,pptx,ppt' //application/octet-stream,
            ],[
                'cv-upload-file.required' => 'Please select a file',
                'cv-upload-file.mimes' => 'Allowed extensions are .zip, .pdf, .doc, .docx, .txt, .rtf, .pptx, .ppt',
            ]);

            if ($validator->fails()) {
                return [ 'status' => 0, 'data' => implode(', ', $validator->errors()->all())  ] ;
                //return redirect()->back()->withErrors($validator)->withInput();
            }
            else
            {
                $randomName = Auth::user()->id."_".get_current_company()->id."_".time()."_";
                $filename = $randomName.$request->file('cv-upload-file')->getClientOriginalName();
                
                $mimeType = $request->file('cv-upload-file')->getMimeType(); 
                
                $upload = $request->file('cv-upload-file')->move(
                        public_path('uploads/CVs/'), $filename
                    );
                $additional_data = [ 'job_id' => @$request->job, 'folder' => @$request->folder, 'options' => $request->options ];

                if( $mimeType == 'application/zip')
                {
                    $this->dispatch(new UploadZipCv($filename, $randomName, $additional_data));
                    // 
                    
                    /*$zippy = Zippy::load();
                    
        
                    //Open File
                      $archive = $zippy->open( public_path('uploads/CVs/') .$filename);

                      //Create temporary directory
                      $tempDir = public_path('uploads/CVs/').$randomName. '/';
                      mkdir( $tempDir );

                      //Extract zip contents to temporary directory
                      $archive->extract( $tempDir );

                      //Delete Zip file
                      unlink(public_path('uploads/CVs/') .$filename);

                      //Instantiate Cv files array
                      $cvs = [];

                      $files = scandir($tempDir);
                    foreach($files as $key => $file) {
                       if(is_file( $tempDir . $file ))
                       {
                            $cv = $key."_".$randomName.$file;
                            $cvs[] = $cv;
                            // move_uploaded_file($tempDir . $file, $cv);
                            rename($tempDir . $file, public_path('uploads/CVs/').$cv);
                            echo $tempDir . $file. " is a file <br/>";
                       }
                       else
                       {
                        echo $tempDir . $file." is not a file <br/>";
                       }
                    }

                    //Delete Temporary directory
                    rrmdir($tempDir);*/

                    

                  return [ 'status' => 1 ,'data' => "You will receive email notification once successfully uploaded" ];
                }
                else
                {
                    $cvs = [  $filename ];
                    $this->saveCompanyUploadedCv($cvs, $additional_data);
                    return [ 'status' => 1 ,'data' => 'Cv(s) uploaded successfully' ] ;
                }


                
                

            }

       
    }

    public function saveCompanyUploadedCv($cvs, $additional_data)
    {
        $settings = new Settings();
        extract($additional_data);
        $last_cv_upload_index = intval( $settings->get('LAST_CV_UPLOAD_INDEX') );
        // $new_cvs = [];
        $cv_source = "";
        
        $options = ( is_null( $options ) ) ? 'upToJob' : $options;

        

        switch ($options) {
            case 'upToJob':
                $cv_source = "Uploaded Candidate";
                break;
            case 'upToFolder':
                $cv_source = $folder;
                break;
            default:
                # code...
                break;
        }


        foreach ($cvs as $key => $cv) {
            $last_cv_upload_index++;


            $last_cv = Cv::insertGetId([ 'first_name' => 'Cv ' . $last_cv_upload_index, 'cv_file' => $cv , 'cv_source' => $cv_source ]);
            
            if($options == 'upToJob'){
                JobApplication::insert([
                        'cv_id' => $last_cv,
                        'job_id' => $job_id,
                        'created' => date('Y-m-d H:i:s'),
                        'action_date' => date('Y-m-d H:i:s'),
                        'status' => 'PENDING',
                    ]);
            }
        }

        $settings->set('LAST_CV_UPLOAD_INDEX',$last_cv_upload_index);
        $user = Auth::user();
        $this->mailer->send('emails.new.cv_upload_successful', ['user' => $user, 'link'=> url('cv/talent-pool') ], function (Message $m) use ($user) {
                $m->from('support@seamlesshiring.com')->to($user->email)->subject('Talent Pool :: File(s) Upload Successful');
            });
        return [ 'status' => 1 ,'data' => 'Cv(s) uploaded successfully' ] ;
    }


    
    
    public function JobList(Request $request){

        $user = Auth::user();
        $user = User::with('companies.jobs')->where('id', $user->id)->first();
        $jobs = get_current_company()->jobs()->orderBy('created_at','desc')->get();
        $company = get_current_company();
        
        $active = 0;
        $suspended = 0;
        $deleted = 0;
        $expired = 0;

        $active_jobs = [];
        $suspended_jobs = [];
        $deleted_jobs = [];
        $expired_jobs = [];


        foreach($jobs as $job){
            if ($job->status == 'DELETED') {
                $deleted_jobs[] = $job;
                $deleted++;
            }
            else if( strtotime($job->expiry_date) <= strtotime( date('m/d/Y h:i:s a', time()) ) ){
                
                $expired_jobs[] = $job;
                $expired++;
            }
            else if ($job->status == 'ACTIVE') {
                $active_jobs[] = $job;
                $active++;
            }
            else if ($job->status == 'SUSPENDED') {
                $suspended_jobs[] = $job;
                $suspended++;
            }
            else{
                // $suspended++;
            }
        }

        $all_jobs = [
                        'ACTIVE' => $active_jobs,
                        'SUSPENDED' => $suspended_jobs,
                        'EXPIRED' => $expired_jobs,
                        // 'DELETED' => $deleted_jobs
                    ];

        return view('job.job-list', compact('jobs', 'active', 'suspended', 'deleted', 'company', 'all_jobs','expired'));
    }

    public function JobPromote($id, Request $request){
      //Check if he  is the owner of the job
        check_if_job_owner( $id );
        $job = Job::find($id);
        $company = $job->company()->first();

        $result = Solr::get_applicants($this->search_params, $id,''); 
      
        $application_statuses = get_application_statuses( $result['facet_counts']['facet_fields']['application_status'] );

        $active_tab = 'promote';


        $job_id = $id;

        // $free_boards = JobBoard::where('type', 'free')->get()->toArray();

        // $job_boards = JobBoard::where('type', 'paid')->where('avi', null)->get()->toArray();

        // $newspapers = JobBoard::where('type', 'paid')->where('avi', 1)->get();

        $subscribed_boards = $job->boards()->get()->toArray();

        $approved_count = array_filter( array_pluck( $subscribed_boards, 'url' ), function(){ 

                if(@$subscribed_board['url'] != null && @$subscribed_boards['url'] != '')
                {
                    return true;
                }
                else
                {
                    return false;
                }
         } );

        $approved_count = count( $approved_count );


        $pending_count = count($subscribed_boards) - $approved_count;

        return view('job.board.home', compact('subscribed_boards', 'job_id','job', 'active_tab', 'company','result','application_statuses','approved_count', 'pending_count'));
    }

    public function JobTeam($id, Request $request){
        //Check if he  is the owner of the job
        check_if_job_owner( $id );
        $comp_id = get_current_company()->id;

        $company  = Company::with('users')->find($comp_id); 

        $owner = $company->users()->first();
        
        $job = Job::find($id);
        $active_tab = 'team';

        $result = Solr::get_applicants($this->search_params, $id,''); 
      
        $application_statuses = get_application_statuses( $result['facet_counts']['facet_fields']['application_status'] );
        // return view('emails.e-exculsively-invited');
        return view('job.board.team', compact('job', 'active_tab', 'company','result','application_statuses','owner'));
    }

    public function ActivityContent(Request $request){

         $content = '<ul class="list-group list-notify">';

        
        if(!empty($request->appl_id)){
            $activities =  JobActivity::with('user', 'application.cv', 'job')->where('job_application_id', $request->appl_id)->orderBy('id', 'desc');
        }elseif($request->type == 'dashboard'){

          
          $comp_id = get_current_company()->id;

          $jobs = Job::where('company_id', $comp_id)->get(['id'])->toArray();
          $activities = JobActivity::with('user', 'application.cv', 'job')->whereIn('job_id', $jobs)->orderBy('id', 'desc');
          // dd($activities);

        }else{
            $activities =  JobActivity::with('user', 'application.cv', 'job', 'job.company')->where('job_id', $request->jobid)->orderBy('id', 'desc');
        }

        if( @$request->allActivities == "true" )
        {

          $activities = $activities->take(20)->get();
        }
        else if( @$request->allActivities == "false" )
        {

            $activities = $activities->skip( 20 * intval(@$request->activities_index) )->take(20)->get();
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
                                    <i class="fa fa-briefcase fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Job Created</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      '. $ac->user->name .' Created a new Job <a href="'. url(@$job->company->slug.'/job/'.$job->id.'/'.str_slug($job->title) )  .'"><strong>'.$job->title.'</strong>.
                                  </p>
                                </li>';                     break;
                 case "APPLIED":

                     $applicant = $ac->application->cv;
                     $job = $ac->application->job;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-edit fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Job Application</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      <a href="'. url('job/applicant/activities/'.$ac->application->id) .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> applied for <strong><a href="'. url('job/candidates/'.$ac->application->job->id) .'" target="_blank">'.$job->title.'</a></strong>
                                  </p>
                                </li>';
                     break;
                  case "SHORTLISTED":
                 $applicant = $ac->application->cv;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-filter fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Shortlist</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      <a href="'. url('job/candidates/'.$ac->application->job->id.'#SHORTLISTED') .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been shortlisted.
                                  </p>
                                </li>';
                     break;

                  case "ASSESSED":
                 $applicant = $ac->application->cv;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-question-circle-o fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Test</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      <a href="'. url('job/candidates/'.$ac->application->job->id.'#ASSESSED') .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been scheduled for test.
                                  </p>
                                </li>';
                     break;


                  case "PENDING":
                 $applicant = $ac->application->cv;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-reply-all fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Return to all</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      <a href="'. url('job/candidates/'.$ac->application->job->id.'#PENDING') .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been returned to all.
                                  </p>
                                </li>';
                     break;

                    case "INTERVIEWED":
                 $applicant = $ac->application->cv;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-thumbs-o-up fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Interview</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      <a href="'. url('job/candidates/'.$ac->application->job->id.'#INTERVIEWED') .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been interviewed.
                                  </p>
                                </li>';
                     break;



                 case "HIRED":
                 $applicant = $ac->application->cv;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Hired</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      <a href="'. url('job/candidates/'.$ac->application->job->id.'#HIRED') .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been hired.
                                  </p>
                                </li>';
                     break;

                  case "WAITING":
                 $applicant = $ac->application->cv;
                     $content .= '<li role="candidate-application" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Waiting</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      <a href="'. url('job/candidates/'.$ac->application->job->id.'#WAITING') .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been added to the waiting list.
                                  </p>
                                </li>';
                     break;

                 case "REJECTED":
                    $applicant = $ac->application->cv;
                    // dd($ac->to);
                    $content .= '<li role="warning-notifications" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-user-times fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-danger">Reject</h5>
                                  <p>
                                      <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small>
                                      <a href="'. url('job/candidates/'.$ac->application->job->id.'#REJECTED') .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> application was rejected by <a href="'. url('applicant/messages/'.$ac->application->id) .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a>
                                  </p>
                                </li>';
                     break;
                 case "COMMENT":
                 $applicant = $ac->application->cv;

                     $content .= '<li role="messaging" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Comment</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']
                                      </small> '. $ac->user->name .' said '.$ac->comment.' about <a href="'. url('applicant/activities/'.$ac->application->id) .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a>
                                  </p>
                                  
                                </li>';
                     break;

                     case "REVIEW":
                     $applicant = $ac->application->cv;
                     

                     $content .= '<li role="messaging" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Comment</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']
                                      </small> '. @$ac->user->name .' commented <span style="display:none;" id="show_activity_comment">"'.$ac->comment.'"</span> on <a href="'. url('applicant/activities/'.$ac->application->id) .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a>
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
                                      <small class="text-muted pull-right">['. date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      '. $ac->user->name .' suspended <a href="#">'.$ac->job->title .'</a> job
                                  </p>
                                  
                                </li>';
                     break;

                     case "PUBLISH-JOB":
                     $content .= '<li role="messaging" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-folder-open fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Publish Job</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
                                      '. $ac->user->name .' published <a href="#">'.$ac->job->title .'</a> job
                                  </p>
                                  
                                </li>';
                     break;

                     case "ADD-TEAM":
                     $content .= '<li role="messaging" class="list-group-item">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Team</h5>
                                  <p>
                                      <small class="text-muted pull-right">['. date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small> 
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
                          
                                  <h5 class="no-margin text-success">Not Set -- '.$ac->activity_type.'</h5>
                                  <p>
                                     
                                  </p>
                                  
                                </li>';
            }

        }
        // dd($act->toArray());

        $content .= '</ul>';

        if( count( $activities ) == 0 )
        {
          $content = '<div class="row">
                            <div class="col-xs-12">
                                <h5 class="text-center text-success text-brandon">You have no activities yet</h5>
                            </div>
                        </div>';
        }

        return $content;
    }

    public function JobActivities($id, Request $request){
         $job = Job::find($id);
         // dd($job);

        //Check if he  is the owner of the job
        check_if_job_owner( $id );

        $active_tab = 'activities';

        $result = Solr::get_applicants($this->search_params, $id,''); 
      
        $application_statuses = get_application_statuses( $result['facet_counts']['facet_fields']['application_status'] );

        $applications = JobApplication::where('job_id',$id)->select("created", DB::raw("DATE_FORMAT(created, '%d-%c-%Y') as created"))->get()->groupBy('created')->toArray();
        //"cust.*", DB::raw("DATE_FORMAT(cust.cust_dob, '%d-%b-%Y') as formatted_dob")

        $applications = array_map(function($value){
            return count($value);
        }, $applications);


        $applications_per_day_chart = Charts::create('line', 'highcharts')
            // ->view('custom.line.chart.view') // Use this if you want to use your own template
            ->title(' ')
            ->elementLabel("Applicants")
            ->labels( array_keys($applications) )
            // ->labels( array_map(function($value){ return date('D. d M Y', strtotime( $value ) ); },  array_keys($applications) ) )
            ->values( array_values($applications) )
            // ->dimensions(1000,500)
            // ->width('100%')
            ->credits(false)
            // ->legend({ 'enabled' : false })
            ->responsive(true);

        return view('job.board.activities', compact('job', 'active_tab', 'content','result','application_statuses','applications_per_day_chart'));
    }

    public function JobCandidates($id, Request $request){
         $job = Job::find($id);
        $active_tab = 'candidates';

        //Check if he  is the owner of the job
        check_if_job_owner( $id );

        return view('job.board.candidates', compact('job', 'active_tab'));
    }

    public function JobMatching($id, Request $request){
         $job = Job::find($id);
        $active_tab = 'matching';

        $result = Solr::get_applicants($this->search_params, $id,''); 
      
        $application_statuses = get_application_statuses( $result['facet_counts']['facet_fields']['application_status'] );


        return view('job.board.matching', compact('job', 'active_tab','result','application_statuses'));
    }


    public function saveCVPreview($cv)
    {
        
    }

    public function JobView($company_slug, $jobid, $job_slug, Request $request = null)
    {
        $company = Company::where('slug', $company_slug)->first();
        $job = Job::where('id', $jobid)->where("company_id",$company->id)->first();
        
        if(empty($job)){
            // redirect to 404 page
        }

        //increment job views

        if( File::exists( public_path( 'uploads/'.@$company->logo ) ) )
        {
            $company->logo = asset('uploads/'.@$company->logo);
        }
        else
        {
            $company->logo = asset('img/company.png');
        }

        return view('job.job-details', compact('job', 'company'));
    }

    public function correctHighestQualification(){
        

        // $j = Cv::where('id','>',4157)->get();

        Cv::where('highest_qualification',10)->chunk( 50, function($cvs){

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

            foreach ($cvs as $cv) {
                // echo $cv->highest_qualification."<br />";
                $cv->highest_qualification = $qualifications[ $cv->highest_qualification ];
                $cv->save();
            }
        });
       
        // dd($j[0]->highest_qualification);
    }

    public function jobApply($jobID, $slug, Request $request){

        $job = Job::with('company')->where('id', $jobID)->first();
        $company = $job->company;
        $specializations = Specialization::get();
        

        if(empty($job)){
            abort(404);
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
        $grades = [

                '1st Class',
                'Distinction',
                'Second Class Upper',
                'Second Class Lower',
                'Upper Credit',
                'Lower Credit',
                '3rd Class',
                'Pass',
                'Other',
                'Unspecified'
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

        $custom_fields  = (object) $job->form_fields;

        if ($request->isMethod('post')) {
                
            $data = $request->all();


            $has_applied = CV::where('email',$data['email'])->orWhere('phone',$data['phone'])->first();
            $owned_cvs = CV::where('email','babatopeoni@gmail.com')->orWhere('phone','+2348050328510')->pluck('id');
            $owned_applicataions_count = JobApplication::whereIn( 'cv_id', $owned_cvs )->where('job_id',$jobID)->get()->count();



            if( $owned_applicataions_count > 0 )
            {
                return redirect()->route('job-applied', ['jobid' => $jobID, 'slug'=>$slug, 'already_applied' => true]);
            }

            

            if ($request->hasFile('cv_file')) {

                $filename = time().'_'.str_slug($request->email).'_'.$request->file('cv_file')->getClientOriginalName();
  
                $data['cv_file'] = $filename;
            } 
            else{
                $data['cv_file'] = null;
            }  
            // dd( $custom_fields[0] );
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
            $cv->highest_qualification = $qualifications[ $data['highest_qualification'] ];
            $cv->last_position = $data['last_position'];
            $cv->last_company_worked = $data['last_company_worked'];
            $cv->years_of_experience = $data['years_of_experience'];
            $cv->graduation_grade = $data['graduation_grade'];
            // $cv->willing_to_relocate = $data['willing_to_relocate'];
            $cv->cv_file = $data['cv_file'];
            $cv->save();

            $cvExt = new CvSalesController();
            $cvExt->ExtractCv( $cv );

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
              
              
              $appl_activities = (save_activities('APPLIED', $jobID, $appl->id, ''));

            if( count( $custom_fields ) > 0 ){

                $custom_field_values = [];

                foreach ($custom_fields as $custom_field) {
                    if( $custom_field->type == 'FILE' )
                    {
                        continue;
                        $name = 'cf_'.str_slug($custom_field->name,'_');
                        if ($request->hasFile( $name ) ){

                            $filename = time().'_'.str_slug($request->email).'_'.$request->file( $name )->getClientOriginalName();
                            $destinationPath = env('fileupload').'/Others';
                            // dd($destinationPath);
                            $request->file( $name )->move($destinationPath, $filename);

                            $value = $filename;
                        }
                    }

                    else if( $custom_field->type == 'MULTIPLE_OPTION' ){
                        $value = implode(',', $request[ 'cf_'.str_slug($custom_field->name,'_') ] ) ;
                    }

                    else if( $custom_field->type == 'CHECKBOX' ){
                        $value = implode(',', $request[ 'cf_'.str_slug($custom_field->name,'_') ] ) ;
                    }

                    else
                    {
                        $value = $request[ 'cf_'.str_slug($custom_field->name,'_') ];
                    }

                    $custom_field_values[] = [
                        'form_field_id' => $custom_field->id,
                        'value' => $value,
                        'job_application_id' => @$appl->id
                    ];
                }

                FormFieldValues::insert( $custom_field_values );
                // dd( $request->all(), $custom_fields, $custom_field_values );
            }

            if ($request->hasFile('cv_file')) {

                $destinationPath = env('fileupload').'/CVs';
                // dd($destinationPath);
                $request->file('cv_file')->move($destinationPath, $data['cv_file']);

            } 


            if( $job->video_posting_enabled )
            {
                return redirect()->route('job-video-application', ['jobid' => $jobID, 'slug'=>$slug, 'appl_id' => $appl->id]);

            }

            return redirect()->route('job-applied', ['jobid' => $jobID, 'slug'=>$slug]);





        }

        // dd($custom_fields);
        
        $company->logo = get_company_logo($company->logo);
        
        
        return view('job.job-apply', compact('job', 'qualifications', 'states', 'company', 'specializations','grades','custom_fields'));

    }

    public function JobVideoApplication($jobID, $job_slug, $appl_id, Request $request)
    {
        $job = Job::with('company')->where('id', $jobID)->first();
        $company = $job->company;
        $company->logo = get_company_logo($company->logo);

        $video_options = VideoApplicationOptions::where('job_id',$jobID)->get();

        if( $request->isMethod('post') )
        {

            $video_application_values = [];
            $score = 0;
            $correct_count = 0;
            foreach ($video_options as $key => $option) {
                //$request->all()

                $video_application_values[] = [
                    'form_field_id' => $option->id,
                    'value' => $request['vo_'.$option->id],
                    'job_application_id' => @$appl_id
                ];

                if( $option->correct_option == $request['vo_'.$option->id] )
                {
                    $correct_count++;
                }

            }

            $score = ( $correct_count / count($video_options) ) * 100;

            VideoApplicationValues::insert( $video_application_values );



            $app = JobApplication::find($appl_id);
            $app->video_application_score = $score;
            $app->save();

            return redirect()->route('job-applied', ['jobid' => $jobID, 'slug'=>$job_slug]);
        }

        return view('job.video-application', compact('job', 'company','video_options'));
    }

    public function JobApplied($jobID, $job_slug, Request $request)
    {
        $job = Job::with('company')->where('id', $jobID)->first();
        $company = $job->company;
        @$already_applied = $request->already_applied;

        if(empty($job)){
            // redirect to 404 page
        }

        $response = Curl::to('https://api.insidify.com/articles/get-posts')
                                ->withData(array('limit'=>6))
                                ->post();

        $posts = @json_decode($response)->data->posts;


        return view('job.applied', compact('job', 'company', 'posts', 'already_applied'));

    }


    public function company($c_url){

        $company = Company::with(['jobs'=>function($query){
                                        $query->where('status', "ACTIVE")
                                        ->orderBy('created_at','desc')
                                        ->where('expiry_date','>',date('Y-m-d'));
                                    }])->where('slug', $c_url)->first();

        // $company->jobs()->orderBy('created_at','desc')->get()->toArray();
        // dd($company);

        if( File::exists( public_path( 'uploads/'.@$company->logo ) ) )
        {
            $company->logo = asset('uploads/'.@$company->logo);
        }
        else
        {
            $company->logo = asset('img/company.png');
        }

        return view('job.company', compact('company'));

    }

    public function MyCompany(){

        $user = Auth::user();
        $company = get_current_company();

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
       
        $job = Job::with('company')->findOrFail($jobid);
        $locations = locations();
        $qualifications = qualifications();
        if($request->isMethod('post')){

           // dd( $request->all(), Carbon::createFromFormat('m/d/Y', $request->expiry_date )->format("Y-m-d H:m:s")  );

          $job->title = $request->title;
          $job->location = $request->job_location;
          $job->job_type = $request->job_type;
          $job->position = $request->position;
          $job->post_date = $request->post_date;
          $job->expiry_date = Carbon::createFromFormat('m/d/Y', $request->expiry_date )->format("Y-m-d H:m:s");
          $job->details = $request->details;
          $job->experience = $request->experience;

          $job->save();
           // $job->update($request->all());
        
            return redirect($job->company->slug.'/job/'.$job->id.'/'.str_slug($job->title));

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
        $job = Job::find($request->job_id);
        $company = get_current_company();
        $mail = Mail::queue('emails.new.job-application', ['job' => $job ,'boards' => $request->boards ,'company' => $company], function ($m) use($company) {
                            $m->from($company->email, 'New Job initiated');

                            $m->to($to)->subject('New Job initiated');
                        });
        
        $private_key = 'test_pr_bbe9d51b272e4a718b01d5c8eb7d2c1f';

        // Retrieve data returned in payment gateway callback
        // $token = $_POST["token"];
        $token = $request->token;
        $amount = $request->amount;
        $amount_currency = $request->currency;
        $sp_status = $request->status;
        $transaction_id = $request->rnd; // we don't really need this here, is just an example


        $data = array (
            'token' => $token,
            'amount' => $amount,
            'amount_currency' => $amount_currency
        );
        $data_string = json_encode($data); //var_dump( $request->all() );

        $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://checkout.simplepay.ng/v1/payments/verify/');
        curl_setopt($ch, CURLOPT_URL, 'https://checkout.simplepay.ng/v2/payments/card/charge/');
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

        $curl_response = curl_exec($ch); //var_dump($curl_response); echo "<br><br><br>";
        $curl_response = preg_split("/\r\n\r\n/",$curl_response); //var_dump($curl_response); echo "<br><br><br>";
        $response_content = $curl_response[1];
        $json_response = json_decode(chop($response_content), TRUE);

        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        /*if ($response_code == '200') {
            // even is http status code is 200 we still need to check transaction had issues or not
            if ($json_response['response_code'] == '20000'){
                // header('Location: success.html');
                // dd('Success');
                return $json_response;
            }else{
                // header('Location: failed.html');
                dd('Failed still');
            }
        } else {
            // header('Location: failed.html');
            dd('Failed');
        }
*/

        if ($response_code == '200') {
            // even is http status code is 200 we still need to check transaction had issues or not
            if ($json_response['response_code'] == '20000') {
                if( $request->type == 'JOB_BOARD' )
                {
                    



                    foreach ($request->boards as $key => $board) {
                        // $b = JobBoard::where('id',$board)->get();
                        $job->boards()->attach($board,  ['url' => '']);

                        // job_board_id,url
                    }


                    $mail = Mail::queue('emails.new.job-application', ['job' => $job ,'boards' => $request->boards ,'company' => $company], function ($m) use($company) {
                            $m->from($company->email, 'New Job Paid');

                            $m->to('funmilola@insidify.com')->subject('New Job Paid');
                        });

                    
                       // $request->boards
                }
                else
                {
                    $this->approveTest( $request->tests, $request->app_ids );    
                }
                
                return "true";
            } else {
                // failed to charge the card
                return "false";
            }
        } else if ($sp_status == 'true') {
            // even though it failed the call to card charge, card payment was already processed
            if( $request->type == 'JOB_BOARD' )
                {



                    foreach ($request->boards as $key => $board) {
                        // $b = JobBoard::where('id',$board)->get();
                        $job->boards()->attach($board,  ['url' => '']);

                        
                    }


                    $mail = Mail::queue('emails.new.job-application', ['job' => $job ,'boards' => $request->boards ,'company' => $company], function ($m) use($company) {
                            $m->from($company->email, 'New Job Paid ');

                            $m->to('funmilola@insidify.com')->subject('New Job Paid');
                        });
                }
                else
                {
                    $this->approveTest( $request->tests, $request->app_ids );    
                }
            return "true";
        } else {
            // failed to charge the card
            return "false";
        }


    }

    private function approveTest($tests, $app_ids){

            foreach ($tests as $key => $test) {
                

                foreach ( $app_ids as $key => $app_id) {
                   $data = [
                        'status'=> 'PENDING'        
                    ];



                                
                    $query = TestRequest::where('job_application_id',$app_id)
                                ->where('test_id',$test['id']);

                    $test = $query->get()->first()->toArray();

                    $query->update($data);



                    $app = JobApplication::with('cv')->find($app_id);



                    $response = Curl::to('http://seamlesstesting.com/test-request')
                                    ->withData( [ 'test_id' => $test['test_id'], 'job_application_id' => $app_id, 'applicant_name' => ucwords( @$app->cv->first_name. " " . @$app->cv->last_name ), 'applicant_email' => $app->cv->email, 'employer_name' => get_current_company()->name, 'employer_email' => get_current_company()->email , 'start_time' => $test['start_time'], 'end_time' => $test['end_time'] ] )
                                    ->post();
                }
                
                // var_dump($data);
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

    public function addCompany(Request $request){

        if ($request->isMethod('post')) {
            // dd($request->request); 

             $validator = Validator::make($request->all(), [
                'slug' => 'unique:companies'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

           
            if( isset( $request->logo ) )
            {
                $file_name  = ($request->logo->getClientOriginalName());                                            
                $fi =  $request->file('logo')->getClientOriginalExtension();
                $logo = $request->company_name.'-'.$file_name;
                $upload = $request->file('logo')->move(
                    env('fileupload'), $logo
                );
            }
            else
            {
                $logo = "";
            }
           

            $comp = Company::FirstorCreate([
                'name' => $request->company_name,
                'email' => $request->company_email,
                'slug' => $request->slug,
                'phone' => $request->phone,
                'website' => $request->website,
                'address' => $request->address,
                'about' => $request->about_company,
                'logo' => $logo,
                'date_added' => date('Y-m-d H:i:s'),
            ]);

            $assoc  = DB::table('company_users')->insert([
                      ['user_id' => Auth::user()->id, 'company_id'=> $comp->id]
            ]);



            // if($upload){      
              return redirect('select-company/'.$request->slug);
            // }
            


        }
        return view('job.add_company');
    }

    public function selectCompany(Request $request)
    {
        foreach (Auth::user()->companies as $key => $company) {
          if( $company->slug == $request->slug)
          {
            Session::put('current_company_index', $key );
            return redirect('dashboard');
          }
        }
    }

    public function getEmbedTest()
    {
        $key = Crypt::encrypt('20~&'.'atolagbemobolaji@gmail.com~&'.'2016-05-27 16:20:10'.'~&13');  
        // dd( $key );

        
        return view('guest.embed-test', compact('key'));
    }

    public function getEmbed(Request $request)
    {
        // allow origin
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        // add any additional headers you need to support here
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With,X-Auth-Token, Origin');

        list($id, $email, $created_at ,$company_id) = explode( '~&', Crypt::decrypt($request->key) );

        // var_dump($id, $email, $created_at);

        $user = User::with('companies')->whereHas('companies', function($query) use($company_id){
                                            $query->where('company_id',$company_id);
                                        })
                                        ->where('id',$id)
                                        // ->where('email', $email."")
                                        ->where('created_at',$created_at)->first();

        if( $user->exists() ){
            $company = Company::find( $company_id );
            $jobs = $company->jobs()->orderBy('created_at','desc')->get()->toArray();
        }
        else
        {
            $company = null;
            $jobs = "Invalid Key";
        }      
        return view('guest.embed-view', compact('jobs','user','company'));
    }

}

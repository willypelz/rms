<?php

namespace App\Http\Controllers;

use DB;
use Cart;
use Curl;
use File;
use Mail;
use Crypt;
use Charts;
use Session;
use App\User;
use App\Models\Cv;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\Role;
use App\Enum\Configs;
use App\Http\Requests;
use App\Jobs\UploadSolrFromCode;
use App\Models\School;
use App\Libraries\Solr;
use App\Models\Company;
use Alchemy\Zippy\Zippy;
use App\Models\Invoices;
use App\Models\JobBoard;
use App\Models\Settings;
use App\Models\Workflow;
use App\Jobs\UploadZipCv;
use App\Models\Candidate;
use App\Models\FormFields;
use App\Models\PrivateJob;
use App\Models\JobActivity;
use App\Models\TestRequest;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Str;
use App\Libraries\Utilities;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Jobs\UploadApplicant;
use App\Models\JobTeamInvite;
use App\Models\JobApplication;
use App\Models\Specialization;
use App\Models\FormFieldValues;
use App\Rules\PrivateEmailRule;
use App\Imports\PrivateJobEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\VideoApplicationValues;
use App\Models\VideoApplicationOptions;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CvSalesController;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Message as CandidateMessage;
use GeneaLabs\LaravelMixpanel\Facades\Mixpanel;
use SeamlessHR\SolrPackage\Facades\SolrPackage;
// use Zipper;

class JobsController extends Controller
{
    private $search_params = ['q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false, 'sort' => 'application_date+desc', 'grouped' => FALSE];

    protected $mailer;
    protected $settings;
    private $states = [
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

	/**
	 * Create a new controller instance.
	 *
	 * @param Mailer $mailer
	 * @param Settings $settings
	 */
    public function __construct(Mailer $mailer, Settings $settings)
    {
        $this->middleware('auth', ['except' => [
            'JobView',
            'jobShare',
            'company',
            'jobApply',
            'JobApplied',
            'JobVideoApplication',
            'getEmbed',
            'getEmbedTest',
            'acceptInvite',
            'declineInvite',
            'selectCompany',
            'makeOldStaffsAdmin',
            'fetchSchools',
        ]]);

        $this->settings = $settings;
        $this->qualifications = qualifications();

        $this->mailer = $mailer;


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    /*public function JobTeamAdd(Request $request)
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
            $user = User::where('email', $request->email)->first();
            $company = Company::find( get_current_company()->id );
            if(empty($user) or is_null($user)){

                $user = User::FirstorCreate([
                  'email' => $request->email,
                  'name' => $request->name
                ]);

                $link = url("password/reset");
            }
            else
            {

                $link = route('select-company',['slug'=>$company->slug]);
            }


            $decline = route('job-team-decline', [ 'ref' => encrypt(  $user->id."_".$company->id) ]);

            $mail_body = $request->body_mail;



            //Add user to company users

            $company->users()->attach($user->id);

            $job = Job::find($request->job_id);

            //Save Invite Code
            $user->invite_code = str_random(40);

            //Send notification mail
            $email_from = ( Auth::user()->email ) ? Auth::user()->email : env('COMPANY_EMAIL');


            $this->mailer->send('emails.new.exclusively_invited', ['user' => $user, 'job_title'=>$job->title, 'company'=>$company->name, 'link'=> $link, 'decline' => $decline], function (Message $m) use ($user) {
                $m->from(env('COMPANY_EMAIL'))->to($user->email)->subject('You have been Exclusively Invited');
            });

            echo 'Saved';
        }


      //$comp->users()->attach($user->id);


    }*/

    public function workflowSelect(Request $request)
    {
        $job = Job::with('workflow.workflowSteps')->find($request->job_id);
        $steps = $job->workflow->workflowSteps;
        $user = User::find($request->user_id);
        $role_id = Role::whereName('interviewer')->first()->id;

        return view('modals.select-interview-step', compact('steps', 'user', 'role_id', 'job'));
    }


    public function resendInvite(Request $request, $inviteId)
    {

        $job_team_invite = JobTeamInvite::find($inviteId);
            $company = Company::find(get_current_company()->id);


            $accept_link = route('accept-invite', ['id' => $job_team_invite->id]);
            $decline_link = route('decline-invite', ['id' => $job_team_invite->id]);

            $mail_body = '&lt;p&gt;Hello,&lt;br&gt;


                                        Regarding the ongoing recruitment process at {{ ucwords( get_current_company()->name ) }} company for the job of {{ ucwords( $job->title ) }}, this is to inform you that you have been invited to join the recruitment team.
                                        You would be required to collaborate with your team in selecting the candidate(s) who best suit(s) the job.';


            $job = Job::find($job_team_invite->job_id);
            $data = (object)$job_team_invite;

            //Send notification mail
            $email_from = (Auth::user()->email) ? Auth::user()->email : env('COMPANY_EMAIL');

            \Illuminate\Support\Facades\Mail::send('emails.new.exclusively_invited', ['data' => $job_team_invite, 'job_title' => $job->title, 'company' => $company->name, 'accept_link' => $accept_link, 'decline_link' => $decline_link], function (Message $m) use ($job_team_invite) {
                $m->from(env('COMPANY_EMAIL'))->to($job_team_invite->email)->subject('You Have Been Exclusively Invited');
            });


            return back();
    }

    public function cancelInvite(Request $request, $inviteId)
    {

        $company = Company::find(get_current_company()->id);


        $job_team_invite = JobTeamInvite::find($inviteId);
        $job_team_invite->is_cancelled = true;
        $job_team_invite->save();

        $job = Job::find($job_team_invite->job_id);
        $data = (object)$job_team_invite;

        //Send notification mail
        $email_from = (Auth::user()->email) ? Auth::user()->email : env('COMPANY_EMAIL');

        \Illuminate\Support\Facades\Mail::send('emails.new.cancel_job_team_invitation', ['data' => $job_team_invite, 'job_title' => $job->title, 'company' => $company->name], function (Message $m) use ($job_team_invite) {
            $m->from(env('COMPANY_EMAIL'))->to($job_team_invite->email)->subject('Notice of cancellation');
        });

        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function JobTeamAdd(Request $request)
    {
        $start = "Initiated Create Job Team(Admin)";
        mixPanelRecord($start, auth()->user());

        try {
            if ($request->mod) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'name' => 'required|string',
                ], [
                    'email.required' => 'Email is required. If you selected an employee, check that they have a valid email',
                    'name.required' => 'Name is required',
                ]);

                if ($validator->fails()) {
                    return back()->with('errors', $validator->getMessageBag()->toArray());
                } else {

                    if ($request->id)
                        $check_email = User::whereEmail($request->email)->where('email', '!=', $request->email)->count();
                    else
                        $check_email = User::whereEmail($request->email)->count();


                    if ($check_email)
                        return back()->with('warning', "The email you entered already exists.");

                    $token = hash_hmac('sha256', str_random(40), config('app.key'));

                    if (isset($request->id)) {

                        $user = User::find($request->id)->update([
                            'email' => $request->email,
                            'name' => $request->name,
                        ]);

                        $user = User::find($request->id);

                    } else {
                        //formerly firstOrCreate but  started failing hence get user in db that already has the email , otherwise create one
                        $user = User::whereEmail($request->email)->first() ?: new User();
                        $user->email = $request->email;
                        $user->name = $request->name;
                        $user->is_super_admin = 1;
                        $user->user_token = $token;
                        $user->save();
                    }


                    if ($user) {

                        $company = Company::find(get_current_company()->id);

                        $accept_link = route('admin-accept-invite', ['id' => $token, 'company_id' => $company->id]);

                        $mail_body = $request->body_mail;

                        $data = [
                            'email' => $request->email,
                            'name' => $request->name,
                            'token' => $token
                        ];

                        $data = (object)$data;
                        $email = $request->email;
                        //Send notification mail
                        //

                        if (isset($request->resend_email) || !isset($request->id)) {
                            \Illuminate\Support\Facades\Mail::send('emails.new.admin_invite', ['data' => $data, 'company' => $company, 'accept_link' => $accept_link], function (Message $m) use ($email) {
                                $m->from(env('COMPANY_EMAIL'))->to($email)->subject('You Have Been Exclusively Invited');
                            });

                            return back()->with('success', "Invite Sent successfully");

                        }

                        return back()->with('success', "Details updated successfully");


                    }
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'name' => 'required|string',
                    'role' => 'required|array',
                    'role_name' => 'required|string'
                ], [
                    'email.required' => 'Email is required. If you selected an employee, check that they have a valid email',
                    'name.required' => 'Name is required',
                    'role.required' => 'Role is required',
                    'role.numeric' => 'Please select a valid role',
                ]);

                if ($validator->fails()) {
                    return response()->json(['status' => 'false', 'message' => $validator->getMessageBag()->toArray()]);
                } else {
                    //Create User


                    $data = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'username' => $request->username,
                        'job_id' => $request->job_id,
                        'role_ids' => json_encode($request->role),
                        'step_ids' => is_null($request->steps) ? json_encode([]) : json_encode($request->steps),
                        'is_internal' => $request->internal ? 1 : 0,
                        'role_name' => $request->role_name
                    ];

                    if (JobTeamInvite::where('job_id', $data['job_id'])->where('email', $data['email'])->count()) {
                        $jobteam = "Failed! Invitee has been added previously (Admin)";
                        mixPanelRecord($jobteam, auth()->user());
                        return response()->json(['status' => false, 'message' => $data['name'] . ' has been invited already']);
                    }

                    $job_team_invite = JobTeamInvite::firstOrCreate($data);
                    $company = Company::find(get_current_company()->id);


                    $accept_link = route('accept-invite', ['id' => $job_team_invite->id]);
                    $decline_link = route('decline-invite', ['id' => $job_team_invite->id]);

                    $mail_body = $request->body_mail;


                    $job = Job::find($request->job_id);
                    $data = (object)$data;

                    //Send notification mail
                    $email_from = (Auth::user()->email) ? Auth::user()->email : env('COMPANY_EMAIL');

                    \Illuminate\Support\Facades\Mail::send('emails.new.exclusively_invited', ['data' => $data, 'job_title' => $job->title, 'company' => $company->name, 'accept_link' => $accept_link, 'decline_link' => $decline_link], function (Message $m) use ($data) {
                        $m->from(env('COMPANY_EMAIL'))->to($data->email)->subject('You Have Been Exclusively Invited');
                    });

                    $jobteam = "Successfully added a member to the Job team(Admin)";
                    mixPanelRecord($jobteam, auth()->user());

                    return response()->json(['status' => true, 'message' => 'Email was sent successfully']);
                }
            }
        }catch(\Exception $e){
            $jobteam = "Failed! Could not add a member to the Job team (Admin)";
            mixPanelRecord($jobteam, auth()->user());
            return back()->with('error','Action failed');
        }
    }




    public function removeJobTeamMember(Request $request)
    {

        $team_member = User::find($request->ref);
        $comp = $request->comp;
        $job = $request->job;
        $ref = $request->ref;

        if ($request->isMethod('post')) {
            $company = Company::find($request->comp);
            $job = Job::find($request->job);

            // $company->users()->detach($request->ref);

            $job->users()->detach($request->ref);
            JobTeamInvite::where('job_id', $job->id)->where('email', $team_member->email)->delete();
            return response()->json(['status' => true, 'message' => 'Removed successfully']);
        }

        return view('modals.job-team-remove', compact('team_member', 'comp', 'job', 'ref'));


    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function acceptInvite($id, Request $request)
    {


        $job_team_invite = JobTeamInvite::find($id);
        $companies = Company::all();
        $job = ($job_team_invite->job_id) ? Job::with('company')->find($job_team_invite->job_id) : null;
        $company = Company::find($job->company->id);
        $is_new_user = true;
        $is_internal = $job_team_invite->is_internal;

        // Check if job invite has been cancelled
        if($job_team_invite->is_cancelled == true) {
            return view('job.cancelled-job-invite', compact('job_team_invite', 'job', 'company'));
        }

        if($job_team_invite->is_declined) {
            $status = false;
            return view('job.decline-invite', compact('company', 'job', 'status'));
        }
        // this is when the user is creating password.. happens to only external team members on first access
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6',
            ]);

            if ($validator->fails()) {
                // delete use from table because user has been created pending when password would be added
                $user = User::find($request->ref);
                $user->delete();
                // set accepted to force so the system recognises user as first time user when next user logs in
                $job_team_invite->is_accepted = 0;
                $job_team_invite->save();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                //persist user password for future authentication
                $user = User::find($request->ref);
                $user->password = bcrypt($request->password);
                $user->activated = 1;
                $user->save();

                $steps = json_decode($job_team_invite->step_ids);
                foreach ($steps as $key => $step) {
                  $user->workflow_steps()->attach($step);
                }

                $job_team_invite->is_accepted = 1;
                $job_team_invite->save();

                auth()->login($user);
                return redirect()->route('select-company', ['slug' => $job->company->slug]);
            }

        } else {
            // when user accesses the link sent as invitation to their email
            //check if user already exist in the system.. meaning is already a team member for some other job
            $user = User::where('email', $job_team_invite->email)->first();
            if ($user) $is_new_user = false;
            // check if user has accepted, declined or is a first time accesser from  the job team invite
            if ($job_team_invite->is_accepted) {
                $status = true;
            } elseif ($job_team_invite->is_declined) {
                $status = false;
            } else {
                if (empty($user) or is_null($user)) {
                    // create user if a first time visitor with link
                    //NOTE: Changed firstOrCreate to save() since it was failing
                    $user = new User();
                    $user->email = $job_team_invite->email;
                    $user->name = $job_team_invite->name;
                    $user->username = $job_team_invite->username;
                    $user->is_internal = $is_internal;
                    $user->save();
                } else {
                    $is_new_user = false;
                }
                // set role to show this is not the job owner or poster of the job
                    $role = 0;
                // assign roles to user
                foreach (json_decode($job_team_invite->role_ids) as $role_id) {
                    $user->roles()->attach($role_id, [
                        'job_id' => $job->id
                    ]);
                }

                $steps = json_decode($job_team_invite->step_ids);
                foreach ($steps as $key => $step) {
                  $user->workflow_steps()->attach($step);
                }

                //  add the user to the job assigned to him
                $job->users()->sync([$user->id => ['role_name' => $job_team_invite->role_name]], false);
                // add the user to the company that owns the job
                $company->users()->sync([$user->id => ['role' => $role]], false);

                }
                //set accepted to true
                $job_team_invite->is_accepted = 1;
                $job_team_invite->save();


            if($is_internal == 0 && $user->password == ''){
                //if user is not external and still hasn't created a password make system assume its a new user
                $job_team_invite->is_accepted = 0;
                $job_team_invite->save();
                unset($status);
                $is_new_user = false;
                // if its not a new user and user is not internal and no current session of the user, log user in
            } elseif (!$is_new_user && !Auth::check() && $is_internal == 0) Auth::loginUsingId($user->id);

        }

        return view('job.accept-invite', compact('job_team_invite', 'job', 'is_new_user', 'user', 'is_internal', 'company'));

    }


    /**
     * Currently, this action assumes that invited team is having company access
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function acceptTeamInvite(Request $request, $id)
    {
        /**
         * - Find the invite user
         * - Show form for signup
         * - Add user to the users table and attach to the company
         */
        // fetch the user data with the job or company that required the user
        $team = JobTeamInvite::with([
            'job',
            'company'
        ])->find($id);

        // show sign up form

        // proccess sign up form
        if ($request->isMethod('post')) {

            $newUser = User::firstOrNew([
                'email' => $team->email,
                'password' => Hash::make($request->input('password')),
            ]);
            $newUser->save();
            // attach user to company
            $team->company();

            // sign team(newly added user) into
            Auth::attempt(['email' => $newUser->email, 'password' => $request->input('password')]);
            return redirect()->route('select-company', ['slug' => $team->company->slug]);

        }

        return view('job.accept-team-invite', compact('team', 'job', 'status', 'is_new_user', 'newUser'));

    }

    public function declineInvite($id)
    {

        $job_team_invite = JobTeamInvite::find($id);
        $job = Job::with('company')->find($job_team_invite->job_id);
        $company = Company::find($job->company->id);

        if ($job_team_invite->is_accepted) {
            $status = true;
        } elseif ($job_team_invite->is_declined) {
            $status = false;
        } else {
            $status = false;
            $job_team_invite->is_declined = true;
            $job_team_invite->save();
        }



        return view('job.decline-invite', compact('company', 'job', 'status'));
    }

    public function JobTeamDecline(Request $request)
    {
        $val = decrypt(@$request->ref);
        list($user_id, $company_id) = explode('_', $val);

        $company = Company::find($company_id);
        $company->users()->detach($user_id);

        Session::flash('status', 'You have been removed from ' . $company->name . '\'s job team');
        return redirect()->to('login');
    }

    public function SaveJob(Request $request)
    {
        $is_update = false;

         if ($request->isMethod('post')) {

            $company = get_current_company();

            if(!isset($request->is_ajax)){
                $this->validate($request, [
                    'title' => 'required',
                    'country'=>'required',
                    'location' => 'required_if:country,Nigeria',
                    'details' => 'required',
                    'job_type' => 'required',
                    'position' => 'required',
                    'expiry_date' => 'required',
                    'workflow_id' => 'required|integer',
                    'experience' => 'required',
	                'minimum_remuneration' => 'numeric|min:0',
	                'maximum_remuneration' => 'numeric|min:0|gt:minimum_remuneration',
                    'attach_email' => ['nullable', new PrivateEmailRule],
                    'bulk' => 'sometimes|required|mimes:csv,txt'
                ], [
                	'maximum_remuneration.gt' => 'maximum remuneration should be greater than minimum remuneration'
                ]);
            }

             $location_value = ($request->country != 'Nigeria') ? $request->country :
                 ( ($request->location == 'Across Nigeria') ? 'Nigeria' : $request->location);

             $job_data = [
                'title' => $request->title,
                'location' => $location_value,
                'summary' => $request->summary,
                'is_for' => $request->eligibility,
                'is_private' => ($request->is_private  == 'true' ? 1 : 0),
                'details' => $request->details,
                'job_type' => $request->job_type,
                'position' => $request->position,
                'post_date' => date('Y-m-d'),
                'expiry_date' => $request->expiry_date,
                // 'status' => 'DRAFT',
                'company_id' => $company->id,
                'workflow_id' => $request->workflow_id,
                'experience' => $request->experience,
                'minimum_remuneration' => $request->minimum_remuneration,
                'maximum_remuneration' => $request->maximum_remuneration,
                'benefits' => $request->benefits,
            ];


            if(empty($request->job_id)){

                $job = Job::firstOrCreate($job_data);

                //attach emails to private jobs
                if($request->is_private){
                    
                    if($request->attach_email){
                        $attached_emails = $request->attach_email;
                        $arr = explode(",",$attached_emails);
    
                        foreach ($arr as $value) {
                            PrivateJob::create(['job_id' => $job->id,'attached_email'=> $value]);
                        }                        
                    }
                    
                    if($request->hasFile('bulk')){
                        //bulk upload
                        $path = $request->file('bulk');
                        $headings = (new HeadingRowImport)->toArray($path);
                        $emails = $headings[0][0];
                        if (!in_array("emails", $emails)) {
                            return redirect()->back()->withInput()->withErrors(['Header row emails not found']);
                        }
                        $data = Excel::import(new PrivateJobEmail($job->id), $path);
                        
                    }
                    
                }

            }else{
                $is_update = true;
                $jb = Job::find($request->job_id);
                $job = $jb;

                //attach emails to private jobs
                if($request->is_private){

                    if($request->attach_email){

                        $request->validate([
                            'attach_email' => ['nullable', new PrivateEmailRule],
                        ]);
                        
                        $attached_emails = $request->attach_email;
                        $arr = explode(",",$attached_emails);

                        foreach ($arr as $value) {
                            PrivateJob::UpdateOrCreate(['job_id' => $job->id,'attached_email'=> $value]);
                        }
                            
                    }
                    
                    if($request->hasFile('bulk')){
                        //bulk upload
                        $request->validate([
                            'bulk' => 'required|mimes:csv,txt'
                        ]);
    
                        $path = $request->file('bulk');
                        $headings = (new HeadingRowImport)->toArray($path);
                        $emails = $headings[0][0];
                        if (!in_array("emails", $emails)) {
                            return redirect()->back()->withInput()->withErrors(['Header row emails not found']);
                        }
                        $data = Excel::import(new PrivateJobEmail($job->id), $path);
                        
                    }
                    
                }

                $jb->update($job_data);  
            }

            if($request->specializations){
                $job->specializations()->detach();
                foreach ($request->specializations as $e) {
                    $job->specializations()->attach($e);
                }
            }
            $user = auth()->user();
            $job->users()->sync([$user->id => ['role_name' => 'Job Admin']], false);
            if(!$user->hasRole('admin')) {
                $admin_role = Role::whereName('admin')->first();
                $user->roles()->attach($admin_role);
            }

            if(!isset($request->is_ajax)){
                $jobSuccess = "Step 1: Job Created Successfully (Admin)";
                mixPanelRecord($jobSuccess, $user);
                return redirect()->route('continue-draft', $job->id);
            }else{
                $redirect_url = route('job-list');
            }

            if($job){
                $jobSuccess = "Job Saved As Draft Successfully (Admin)";
                mixPanelRecord($jobSuccess, $user);
                return ['status' => 200, 'message' => ' Your job has been saved as DRAFT', 'is_update' => $is_update, 'redirect_url'=> $redirect_url ];
            }else
                $jobfailed = "Could not Save Job As Draft(Admin)";
                mixPanelRecord($jobfailed, $user);
                return ['status' => 500, 'message'=>'Your job cannot be saved as DRAFT. Please try again later'];

        }
    }


    public function approveJobPost(Request $request, $id)
    {

        $thirdPartyData = collect(session('third_party_data'));

        $job = Job::find($id);

         if ($request->callback_url) {
                $job_link = url($company->slug . '/job/' . $job->id . '/' . str_slug($job->title));
                $redirect_url = "{$request->callback_url}/{$request->api_key}/{$request->requisition_id}/{$job_link}";
                $callback_url = $request->callback_url;
                $requisition_id = $request->requisition_id;
                $api_key = $request->api_key;
                // set post fields
                $post = [
                    'requisition_id' => $request->requisition_id,
                    'api_key' => $request->api_key,
                ];
                $job_link = urlencode($job_link);
                $url = "{$callback_url}?api_key={$api_key}&requisition_id={$requisition_id}&job_link={$job_link}";
                // Get cURL resource
                $curl = curl_init();
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_URL => $url,
                ));

                // Send the request & save response to $resp
                $resp = curl_exec($curl);
                $error = curl_error($curl);
                // Close request to clear up some resources
                curl_close($curl);
                $resp = json_decode($resp, true);
                if ($resp['status']) {
                    return redirect($callback_url);
                }

                return view('utils.staffstrength_data', compact('job_link', 'callback_url', 'requisition_id', 'api_key'));
            }

            $job_boards = JobBoard::where('type', 'free')->get()->toArray();
            $urls = $bds = [];

            if(count($job_boards) > 2){
                $c = (count($job_boards) / 2);
                $t = array_chunk($job_boards, $c);
                $board1 = $t[0];
                $board2 = $t[1];

                foreach ($job_boards as $s) {
                    $bds[] = ($s['id']);
                    $urls[$s['id']] = "";
                }

            }else{
                $board1 = [];
                $board2 = [];
            }




            $pickd_boards = [];


            $out_boards = array();
            foreach ($pickd_boards as $p) {
                if (in_array($p, $bds))
                    $job->boards()->attach($p, ['url' => $urls[$p]]);
                $out_boards[] = JobBoard::where('id', $p)->first()->name;
            }
            $flash_boards = implode(', ', $out_boards);


            Job::find($id)->update(['status' => 'ACTIVE']);

            Session::flash('flash_message', 'Congratulations! Your job has been posted on ' . $flash_boards . '. You will begin to receive applications from those job boards shortly - <i>this is definite</i>.');
            
            $jobApproved = "Step 4: Job Confirmed and Approved successfully Page(Admin)";
            mixPanelRecord($jobApproved, auth()->user());

            return redirect()->route('job-candidates', $job->id);
    }

    public function confirmJobDetails(Request $request, $id)
    {
        $job = Job::with('form_fields', 'specializations', 'workflow')->find($id);
        $selected_fields = json_decode($job->fields);
        $selected_form_fields = $job->form_fields;

        $job_specializations = $job->specializations->take(3)->pluck('name');

        $jobConfirm = "Step 3: Proceeded to Job Confirmation Page(Admin)";
        mixPanelRecord($jobConfirm, auth()->user());

        return view('job.confirm-job-post', compact('job', 'selected_fields', 'job_specializations', 'selected_form_fields'));
    }

    public function continueJob(Request $request, $id)
    {

        $job = Job::with('form_fields')->find($id);

        $application_fields = config('constants.application_fields');
        $selected_fields = json_decode($job->fields);
        $selected_form_fields = $job->form_fields;


        if($request->isMethod('post')){

            // Saving default fields attributes
            foreach ($application_fields as $key => $application_field) {
                $fields[$key] = [
                    'is_required' => (isset($request->is_required[$key])) ? 1 : 0,
                    'is_visible' => (isset($request->is_visible[$key])) ? 1 : 0,
                ];
            }

            if($fields){
                // Save into the Job Application
                Job::find($id)->update([ 'fields' => json_encode($fields) ]);
            }

            // Delete all Custom fields associated to this Job

             if (isset($request->custom_names) and $request->custom_names != null) {
                $custom_data = [];
                for ($i = 0; $i < count($request->custom_names); $i++) {
                    $custom_data[] = [
                        'name' => $request->custom_names[$i],
                        'type' => $request->custom_types[$i],
                        'options' => $request->custom_options[$i],
                        'is_required' => $request->custom_required[$i],
                        'is_visible' => $request->custom_visible[$i],
                        'job_id' => $job->id,
                    ];
                }

                // Insert New added custom fields
                foreach($custom_data as $cd){

                    if($job->form_fields){
                        // Check custom data item is in the Database Array
                        $check_data = $job->form_fields->where('name', $cd['name'])->first();
                        // If Not Present - Add
                        if(!$check_data){
                            FormFields::insert($cd);
                        }

                    }else
                        FormFields::insert($custom_data);

                }

                // Delete Ones not here
                foreach($job->form_fields as $saved_field){
                    $get = $this->searchForName($saved_field['name'], $custom_data);
                    if(is_null($get))
                        $saved_field->delete();

                }
            }

            $redirect_url = route('confirm-job-post', $id);

            if($request->ajax()){
                $continue = "Step 2: Job Saved as Draft Successfully(Admin)";
                mixPanelRecord($continue, auth()->user());
                return ['status' => 200, 'message' => ' Your job details has been updated and saved as DRAFT', 'is_update' => true, 'redirect_url' => $redirect_url ];
            }else
                $continue = "Step 2: Job Updated with Custom Fields and Form Fields Successfully(Admin)";
                mixPanelRecord($continue, auth()->user());
                return redirect()->route('confirm-job-post', $id);
        }



        return view('job.continue-job-post', compact('job', 'selected_fields', 'selected_form_fields', 'application_fields'));
    }


    public function PostJob(Request $request)
    {
        // Another approach.. Get data from session
        $thirdPartyData = collect(session('third_party_data'));

        $application_fields = config('constants.application_fields');
        $qualifications = qualifications();
        $locations = locations();
        $countries = countries();
        $specializations = Specialization::get();

        $user = Auth::user();
        $company = get_current_company();
        $job_boards = JobBoard::where('type', 'free')->get()->toArray();

        $urls = $bds = [];

        if(count($job_boards) > 2){
            $c = (count($job_boards) / 2);
            $t = array_chunk($job_boards, $c);
            $board1 = $t[0];
            $board2 = $t[1];

            foreach ($job_boards as $s) {
                $bds[] = ($s['id']);
                $urls[$s['id']] = "";
            }

        }else{
            $board1 = [];
            $board2 = [];
        }


        //Free Job boards urls
        $insidify_url = "";

        if ($request->isMethod('post')) {

            $pickd_boards = [];


            $data = [
                'job_title' => $request->job_title,
                'job_location' => $request->job_location,
                'details' => $request->details,
                'country'=>$request->country,
                'job_type' => $request->job_type,
                'position' => $request->position,
                'expiry_date' => $request->expiry_date,
                'workflow_id' => $request->workflow_id,
                'experience' => $request->experience,
            ];

            $validator = Validator::make($data, [
                'job_title' => 'required',
                'country'=>'required',
                'job_location' => 'required_if:country,Nigeria',
                'details' => 'required',
                'job_type' => 'required',
                'position' => 'required',
                'expiry_date' => 'required',
                'workflow_id' => 'required|integer',
                'experience' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $pickd_boards = [];

                //get field visibilities
                $fields = [];

                foreach ($application_fields as $key => $application_field) {
                    $fields[$key] = [
                        'is_required' => (isset($request->is_required[$key])) ? 1 : 0,
                        'is_visible' => (isset($request->is_visible[$key])) ? 1 : 0,
                    ];
                }
                $location_value = ($request->country != 'Nigeria') ? $request->country :
                    ( ($request->job_location == 'Across Nigeria') ? 'Nigeria' : $request->job_location);

                $job_data = [
                    'title' => $request->job_title,
                    'location' => $location_value,
                    'details' => $request->details,
                    'job_type' => $request->job_type,
                    'position' => $request->position,
                    'post_date' => date('Y-m-d'),
                    'expiry_date' => $request->expiry_date,
                    'status' => 'ACTIVE',
                    'company_id' => $company->id,
                    'workflow_id' => $request->workflow_id,
                    'is_for' => $request->is_for ?: 'external',
                    'fields' => json_encode($fields),
                    'experience' => $request->experience,
                ];

                $job = Job::FirstorCreate($job_data);

                //Send New job notification email
                $to = env('COMPANY_EMAIL');
                $mail = Mail::send('emails.new.job-application', ['job' => $job, 'boards' => null, 'company' => $company], function ($m) use ($company, $to) {
                    $m->from($to, @$company->name);
                    $m->to($to)->subject('New Job initiated');
                });

                $urls[1] = "";

                //Save job creation to activity
                save_activities('JOB-CREATED', $job->id);

                //save custom fields
                if (isset($request->custom_names) and $request->custom_names != null) {
                    $custom_data = [];
                    for ($i = 0; $i < count($request->custom_names); $i++) {
                        $custom_data[] = [
                            'name' => $request->custom_names[$i],
                            'type' => $request->custom_types[$i],
                            'options' => $request->custom_options[$i],
                            'is_required' => $request->custom_required[$i],
                            'is_visible' => $request->custom_visible[$i],
                            'job_id' => $job->id,
                        ];
                    }
                    FormFields::insert($custom_data);
                }

                $out_boards = array();
                foreach ($pickd_boards as $p) {
                    if (in_array($p, $bds))
                        $job->boards()->attach($p, ['url' => $urls[$p]]);
                    $out_boards[] = JobBoard::where('id', $p)->first()->name;
                }
                $flash_boards = implode(', ', $out_boards);

                foreach ($request->specializations as $e) {
                    $job->specializations()->attach($e);
                }

            }
            if ($request->callback_url) {
                $job_link = url($company->slug . '/job/' . $job->id . '/' . str_slug($job->title));
                $redirect_url = "{$request->callback_url}/{$request->api_key}/{$request->requisition_id}/{$job_link}";
                $callback_url = $request->callback_url;
                $requisition_id = $request->requisition_id;
                $api_key = $request->api_key;
                // set post fields
                $post = [
                    'requisition_id' => $request->requisition_id,
                    'api_key' => $request->api_key,
                ];
                $job_link = urlencode($job_link);
                $url = "{$callback_url}?api_key={$api_key}&requisition_id={$requisition_id}&job_link={$job_link}";
                // Get cURL resource
                $curl = curl_init();
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_URL => $url,
                ));

                // Send the request & save response to $resp
                $resp = curl_exec($curl);
                $error = curl_error($curl);
                // Close request to clear up some resources
                curl_close($curl);
                $resp = json_decode($resp, true);
                if ($resp['status']) {
                    return redirect($callback_url);
                }

                return view('utils.staffstrength_data', compact('job_link', 'callback_url', 'requisition_id', 'api_key'));
            }

            Session::flash('flash_message', 'Congratulations! Your job has been posted on ' . $flash_boards . '. You will begin to receive applications from those job boards shortly - <i>this is definite</i>.');
            return redirect()->route('post-success', ['jobID' => $job->id]);
        }

        $workflows = Workflow::whereCompanyId(get_current_company()->id)->get();

        return view('job.create', compact(
            'qualifications',
            'specializations',
            'board1',
            'board2',
            'locations',
            'countries',
            'workflows',
            'thirdPartyData',
            'application_fields'
        ));
    }


    public function createJob(Request $request, $id='')
    {
        if(!empty($id)){
            $job = Job::with('specializations')->find($id);

            // Get the specialization relations --- Using with callback didnt work, returns pivot
            if($job->specializations){
                $job_specilizations = $job->specializations()->pluck('specializations.id')->toArray();
            }
            $checkCandidateStep = JobApplication::where('job_id',$id)->where('status','!=','PENDING')->first();
        }else{
            $job = NULL;
            $job_specilizations = [];
            $checkCandidateStep = NULL;

            $start = "Initiated Create Job(Admin)";
            mixPanelRecord($start, auth()->user());
        }

        // Another approach.. Get data from session
        $thirdPartyData = collect(session('third_party_data'));

        $application_fields = config('constants.application_fields');
        $qualifications = qualifications();
        $locations = locations();
        $countries = countries();
        $specializations = Specialization::get();

        $user = Auth::user();
        $company = get_current_company();
        $job_boards = JobBoard::where('type', 'free')->get()->toArray();

        if(count($job_boards) > 2){
            $c = (count($job_boards) / 2);
            $t = array_chunk($job_boards, $c);
            $board1 = $t[0];
            $board2 = $t[1];
        }else{
            $board1 = [];
            $board2 = [];
        }

        $urls = [];
        foreach ($job_boards as $s) {
            $bds[] = ($s['id']);
            $urls[$s['id']] = "";
        }

        //Free Job boards urls
        $insidify_url = "";

        if ($request->isMethod('post')) {

            $pickd_boards = [];

            $data = [
                'job_title' => $request->job_title,
                'job_location' => $request->job_location,
                'details' => $request->details,
                'country'=>$request->country,
                'job_type' => $request->job_type,
                'position' => $request->position,
                // 'post_date' => $request->post_date,
                'expiry_date' => $request->expiry_date,
                'workflow_id' => $request->workflow_id,
                'experience' => $request->experience,
            ];

            $validator = Validator::make($data, [
                'job_title' => 'required',
                'country'=>'required',
                'job_location' => 'required_if:country,Nigeria',
                'details' => 'required',
                'job_type' => 'required',
                'position' => 'required',
                'expiry_date' => 'required',
                'workflow_id' => 'required|integer',
                'experience' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $pickd_boards = [];

                //get field visibilities
                $fields = [];

                foreach ($application_fields as $key => $application_field) {
                    $fields[$key] = [
                        'is_required' => (isset($request->is_required[$key])) ? 1 : 0,
                        'is_visible' => (isset($request->is_visible[$key])) ? 1 : 0,
                    ];
                }
            $location_value = ($request->country != 'Nigeria') ? $request->country :
                             ( ($request->job_location == 'Across Nigeria') ? 'Nigeria' : $request->job_location);
                $job_data = [
                    'title' => $request->job_title,
                    'location' => $location_value,
                    'details' => $request->details,
                    'job_type' => $request->job_type,
                    'position' => $request->position,
                    'post_date' => date('Y-m-d'),
                    'expiry_date' => $request->expiry_date,
                    'status' => 'ACTIVE',
                    'company_id' => $company->id,
                    'workflow_id' => $request->workflow_id,
                    'is_for' => $request->is_for,
                    'is_private' => ($request->is_private  == 'true' ? 1 : 0),
                    'fields' => json_encode($fields),
                    'experience' => $request->experience,
                ];
                $job = Job::firstOrCreate($job_data);

                //Send New job notification email
                $to = env('COMPANY_EMAIL');
                $mail = Mail::send('emails.new.job-application', ['job' => $job, 'boards' => null, 'company' => $company], function ($m) use ($company, $to) {
                    $m->from($to, @$company->name);

                    $m->to($to)->subject('New Job initiated');
                });

                // $insidify_url = Curl::to("https://insidify.com/ss-post-job")
                //             ->withData(  [ 'secret' => '1ns1d1fy', 'data' =>  [ 'job' => $job_data, 'specializations' => @$request->specializations, 'company' => get_current_company()->toArray(), 'action_link' => url('job/apply/'.$job->id.'/'.str_slug($job->title) ) ]  ]  )
                //             // ->asJson()
                //             ->post();
                // $urls[1] = $insidify_url;
                //
                $urls[1] = "";

                //Save job creation to activity
                save_activities('JOB-CREATED', $job->id);

                //save custom fields
                if (isset($request->custom_names) and $request->custom_names != null) {
                    $custom_data = [];
                    for ($i = 0; $i < count($request->custom_names); $i++) {
                        $custom_data[] = [
                            'name' => $request->custom_names[$i],
                            'type' => $request->custom_types[$i],
                            'options' => $request->custom_options[$i],
                            'is_required' => $request->custom_required[$i],
                            'is_visible' => $request->custom_visible[$i],
                            'job_id' => $job->id,
                        ];
                    }
                    FormFields::insert($custom_data);
                }

                $out_boards = array();
                foreach ($pickd_boards as $p) {
                    if (in_array($p, $bds))
                        $job->boards()->attach($p, ['url' => $urls[$p]]);
                    $out_boards[] = JobBoard::where('id', $p)->first()->name;
                }
                $flash_boards = implode(', ', $out_boards);

                foreach ($request->specializations as $e) {
                    $job->specializations()->attach($e);
                }

            }
            if ($request->callback_url) {
                $job_link = url($company->slug . '/job/' . $job->id . '/' . str_slug($job->title));
                $redirect_url = "{$request->callback_url}/{$request->api_key}/{$request->requisition_id}/{$job_link}";
                $callback_url = $request->callback_url;
                $requisition_id = $request->requisition_id;
                $api_key = $request->api_key;
                // set post fields
                $post = [
                    'requisition_id' => $request->requisition_id,
                    'api_key' => $request->api_key,
                ];
                $job_link = urlencode($job_link);
                $url = "{$callback_url}?api_key={$api_key}&requisition_id={$requisition_id}&job_link={$job_link}";
                // Get cURL resource
                $curl = curl_init();
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_URL => $url,
                ));

                // Send the request & save response to $resp
                $resp = curl_exec($curl);
                $error = curl_error($curl);
                // Close request to clear up some resources
                curl_close($curl);
                $resp = json_decode($resp, true);
                if ($resp['status']) {
                    return redirect($callback_url);
                }
                return view('utils.staffstrength_data', compact('job_link', 'callback_url', 'requisition_id', 'api_key'));
            }

            Session::flash('flash_message', 'Congratulations! Your job has been posted on ' . $flash_boards . '. You will begin to receive applications from those job boards shortly - <i>this is definite</i>.');
            return redirect()->route('post-success', ['jobID' => $job->id]);
        }

        $workflows = Workflow::whereCompanyId(get_current_company()->id)->get();

        return view('job.post_job', compact(
            'qualifications',
            'specializations',
            'board1',
            'job', 'job_specilizations',
            'board2',
            'locations',
            'workflows',
            'thirdPartyData',
            'application_fields',
            'countries',
            'checkCandidateStep'
        ));
    }


    public function PostSuccess(Request $request)
    {
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
        $approved_count = $pending_count = 0;

        foreach ($subscribed_boards as $key => $board) {

            if ($board['pivot']['url'] != '') {
                $approved_count++;
            } else {
                $pending_count++;
            }
        };
        $subscribed_boards_id = array_pluck($subscribed_boards, 'id');

        // $all_job_boards = JobBoard::where('type', 'free')->get()->toArray();
        $all_job_boards = JobBoard::all()->toArray();


        return view('job.success-old', compact('job', 'insidify_url', 'subscribed_boards', 'approved_count', 'pending_count', 'all_job_boards', 'subscribed_boards_id'));
    }



    public function Advertise($jobid, $slug = null)
    {

        $job_boards = JobBoard::where('type', 'paid')->where('avi', null)->get()->toArray();

        $newspapers = JobBoard::where('type', 'paid')->where('avi', 1)->get();

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

        if (empty($ids))
            $ids = null;


        return view('job.advertise', compact('newspapers', 'job_boards', 'ids', 'cart', 'count', 'price', 'jobid', 'slug'));
    }

    public function Share($id)
    {

        $user = Auth::user();
        $company = get_current_company();

        $job = Job::find($id);

        return view('job.share', compact('company', 'job', 'user'));
    }




    public function AddCandidates($jobid = null)
    {

        $myFolders = [];

        $job = NULL;

        if (!empty($jobid)) {
            $job = Job::find($jobid);
        }

        $myJobs = Job::getMyJobs();
        $cv_array = SolrPackage::get_all_my_cvs($this->search_params, null, null)['response']['docs'];

        if(!empty($cv_array)){
            $myFolders = array_unique(array_pluck($cv_array, 'cv_source'));

            if (($key = array_search('Direct Application', $myFolders)) !== false) {
                unset($myFolders[$key]);
            }

        }

        $states = $this->states;
        $qualifications = $this->qualifications;
        $grades = grades();
        return view('job.add-candidates', compact('jobid', 'job', 'myJobs', 'myFolders', 'states', 'qualifications', 'grades'));
    }


    public function UploadCVfile(Request $request)
    {
        $validation_fields_copy = ['cv-upload-file.required' => 'Please select a file'];

        if ($request->type == "single") {
            $validation_fields['cv_first_name'] = 'required';
            $validation_fields['cv_last_name'] = 'required';
            $validation_fields['cv_email'] = 'required';
            $validation_fields['cv_phone'] = 'required';
            $validation_fields['gender'] = 'required';
            $validation_fields['country'] = 'required';
            $validation_fields['location'] = 'required_if:country,Nigeria';
            $validation_fields['highest_qualification'] = 'required';
            $validation_fields['years_of_experience'] = 'required';
            $validation_fields['last_company_worked'] = 'required';
            $validation_fields['last_position'] = 'required';
            $validation_fields['willing_to_relocate'] = 'required';
            $validation_fields['graduation_grade'] = 'required';

            $validation_fields_copy = [];
            $validation_fields_copy['cv_first_name.required'] = 'First name is required';
            $validation_fields_copy['cv_last_name.required'] = 'Last name is required';
            $validation_fields_copy['cv_email.required'] = 'Email is required';
            $validation_fields_copy['cv_phone.required'] = 'Phone number is required';
            $validator = Validator::make($request->all(), $validation_fields, $validation_fields_copy);
            
            
            if($validator->fails()) {
                return ['status' => 0, 'data' => $validator->errors()->all()];
            }
        }

        $extension = $request->file('cv-upload-file') ? $request->file('cv-upload-file')->getClientOriginalExtension() : null;
        if($request->type == "single"){
            $allowed_file_extentions = ['pdf','doc','docx','txt','rtf','pptx','ppt'];
            if (!in_array($extension, $allowed_file_extentions)) {
                return ['status' => 0, 'data' => ['Allowed extensions are .pdf, .doc, .docx, .txt, .rtf, .pptx, .ppt']];
            }
        }else{
            if ($extension != 'zip') {
                return ['status' => 0, 'data' => ['Allowed extension is .zip']];
            }
        }
        $randomName = Auth::user()->id . "_" . get_current_company()->id . "_" . time() . "_";
        $filename = $randomName . $request->file('cv-upload-file')->getClientOriginalName();

        $mimeType = $request->file('cv-upload-file')->getMimeType();

        $upload = $request->file('cv-upload-file')->move(
            public_path('uploads/CVs/'), $filename
        );
        $additional_data = ['job_id' => @$request->job, 'folder' => @$request->folder, 'options' => $request->options];

        if ($mimeType == 'application/zip') {
            $request_data = json_encode($request->all());
            $this->dispatch(new UploadZipCv($filename, $randomName, $additional_data, $request_data));
            return ['status' => 1, 'data' => ["You will receive email notification once successfully uploaded"]];
        } else {
            $cvs = [$filename];
            saveCompanyUploadedCv($cvs, $additional_data, $request);
            return ['status' => 1, 'data' => ['Cv(s) uploaded successfully']];
        }
        UploadSolrFromCode::dispatch();
        return $response;
    }


	public function adminUploadDocument(Request $request)
	{

		$request->validate([
			'document_file' => 'required|mimes:zip,pdf,doc,docx,txt,rtf,pptx,ppt,jpg,jpeg,png',
		]);

		if ($request->hasFile('document_file')) {

			$file_name = (@$request->document_file->getClientOriginalName());
			$fi = @$request->file('document_file')->getClientOriginalExtension();
			$document_file = $request->application_id . '-' . time() . '-' . $file_name;

			$upload = $request->file('document_file')->move(
				env('fileupload'), $document_file
			);
		} else {
			$document_file = '';
		}
		$message = CandidateMessage::create([
			'job_application_id' => $request->appl_id,
			'description' => $request->document_description,
			'title' => $request->document_title,
			'attachment' => $document_file,
		]);
		return ['status' => 1, 'data' => ['Documents Uploaded successfully']];
	}

	public function JobList(Request $request)
	{
        $user = User::with([
            'companies.jobs'
        ])->where('id', Auth::user()->id)
            ->first();

        $company = get_current_company();
        $jobsOrm = $company->jobs()->with([
            'workflow.workflowSteps' => function ($q) {
                return $q->orderBy('order', 'asc');
            }
        ]);

        $jobs = $jobsOrm->orderBy('created_at', 'desc');

        $job_access = Job::where('company_id', $company->id)->whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->get()->pluck('id')->toArray();

        $is_super_admin = $user->is_super_admin;

        if (isset($request->q)) {
            $jobs = $jobs->where('title', 'LIKE', '%' . $request->q . '%');
        }
        if (!$is_super_admin) {
            $jobs = $jobs->whereIn('id', $job_access);
        }

        $jobs = $jobs->with('workflow.workflowSteps.users')->paginate(Configs::PAGINATION_NUMBER);
        $active = 0;
        $suspended = 0;
        $deleted = 0;
        $expired = 0;
        $draft = 0;
        $private = 0;

        $active_jobs = [];
        $suspended_jobs = [];
        $deleted_jobs = [];
        $expired_jobs = [];
        $draft_jobs = [];
        $private_jobs = $jobs->where('is_private', true)->whereNotIn('status', ['DELETED', 'SUSPENDED', 'DRAFT']);
        $private = count($private_jobs);

        foreach ($jobs as $job) {
            if ($job->status == 'DELETED') {
                $deleted_jobs[] = $job;
                $deleted++;
            } else if (Carbon::now()->diffInDays(Carbon::parse($job->expiry_date), false) < 0) {

                $expired_jobs[] = $job;
                $expired++;
            } else if ($job->status == 'ACTIVE') {
                $active_jobs[] = $job;
                $active++;
            } else if ($job->status == 'SUSPENDED') {
                $suspended_jobs[] = $job;
                $suspended++;
            } else if ($job->status == 'DRAFT') {
                $draft_jobs[] = $job;
                $draft++;
            }

        }


        $all_jobs = [
            'ACTIVE' => $active_jobs,
            'SUSPENDED' => $suspended_jobs,
            'EXPIRED' => $expired_jobs,
            'DRAFT' => $draft_jobs,
            'PRIVATE' => $private_jobs
            //  'DELETED' => $deleted_jobs  TODO
        ];

        @$q = @$request->q;

        return view('job.job-list', compact('jobs', 'draft', 'active', 'suspended', 'deleted', 'company', 'all_jobs', 'expired', 'q', 'private'));
    }

    public function JobPromote($id, Request $request)
    {
        //Check if he  is the owner of the job
        check_if_job_owner($id);
        $job = Job::find($id);
        $company = $job->company()->first();
        $myFolders = [];

        $active_tab = 'promote';


        $job_id = $id;
        $states = $this->states;
        $qualifications = $this->qualifications;
        $grades = grades();

        $subscribed_boards = $job->boards()->get()->toArray();

        $approved_count = $pending_count = 0;

        foreach ($subscribed_boards as $key => $board) {

            if ($board['pivot']['url'] != '') {
                $approved_count++;
            } else {
                $pending_count++;
            }
        };

        $myJobs = Job::getMyJobs();

        $cv_arrayray = SolrPackage::get_all_my_cvs($this->search_params, null, null)['response']['docs'];


        if(!empty($cv_array)){
            $myFolders = array_unique(array_pluck($cv_array, 'cv_source'));
        }

        mixPanelRecord("Job promote page accessed", auth()->user());

        return view('job.board.home', compact('subscribed_boards', 'job_id', 'job', 'active_tab', 'company', 'approved_count', 'pending_count', 'myJobs', 'myFolders', 'states', 'qualifications', 'grades'));
    }

    public function JobTeam($id, Request $request)
    {

        //Check if he  is the owner of the job
        check_if_job_owner($id);
        $comp_id = get_current_company()->id;

        $company = Company::with('users')->find($comp_id);

        $owner = $company->users()->first();

        $job = Job::with('workflow.workflowSteps')->find($id);
        $active_tab = 'team';


        $roles = Role::select('id', 'display_name', 'name')->get();

        $job_team_invites = JobTeamInvite::where('job_id', $job->id)->where('is_accepted', 0)->where('is_declined', 0)->get();
        $interviewer_id = $roles->where('name','interviewer')->first()->id;

        return view('job.board.team', compact('job', 'active_tab', 'company', 'owner', 'job_team_invites', 'roles', 'interviewer_id'));
    }


    public function persisRole(Request $request)
    {
        $user = User::find($request->user_id);
        $user_roles = $user->roles()->where('job_id', $request->job_id)->get();
        $exist = false;
        $interviewer_id = Role::where('name','interviewer')->first()->id;

        if($request->checked){
            foreach ($user_roles as $role) {
                if($role->id == $request->role_id) {
                    $exist = true;
                    break;
                    //do nothing
                }
            }
            if(!$exist) {
                $user->roles()->attach($request->role_id, ['job_id' => $request->job_id]);
                if($request->steps) {
                    foreach ($request->steps as $key => $step) {
                        $user->workflow_steps()->attach($step);
                    }
                }
            }
        } else {
            if($interviewer_id == $request->role_id){
                $user->workflow_steps()->detach();
            }
            $user->roles()->where('job_id', $request->job_id)->detach($request->role_id);

        }
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully'
        ]);
    }

    public function jobTemSettings(Request $request, $job_id)
    {

        $jobs = Job::with(['users'=> function ($q) { $q->where('users.id', 4); } ])->take(5)->get();

        $permissions = [];
        foreach($jobs as $job){

            $can_view = 0;
            $can_edit = 0;
            if(!empty($job->users->toArray())){
                $can_view = $job->users[0]->can_view;
                $can_edit = $job->users[0]->can_edit;
            }

            $permissions[] = ['id' => $job->id, 'title' => $job->title, 'can_view' => $can_view, 'can_edit' => $can_edit];

        }


        return view('job.team.settings', compact('jobs', 'permissions'));
    }



    public function ActivityContent(Request $request)
    {
        $user = Auth::user();
        $comp_id = get_current_company()->id;
        $job_access = Job::where('company_id', $comp_id)
                        ->whereHas('users', function ($q) use ($user){
                            $q->where('user_id', $user->id);
                        })->get()->pluck('id')->toArray();


        $content = '<ul class="list-group list-notify">';
        $shouldAppend = true;
        $activities_pager = 20;
        $isThereMoreActivities = false;

       
        if (!empty($request->appl_id)) {
            $activities = JobActivity::with('user', 'application.cv', 'job')->where('job_application_id', $request->appl_id)->orderBy('id', 'desc');
        } elseif ($request->type == 'dashboard') {
            $jobs = ($user->is_super_admin) ? Job::where('company_id', $comp_id)->get(['id'])->toArray() : $job_access;
            $activities = JobActivity::with('user', 'application.cv', 'job')->whereIn('job_id', $jobs)->orderBy('id', 'desc');


        } else {
            $activities = JobActivity::with('user', 'application.cv', 'job', 'job.company')->where('job_id', $request->jobid)->orderBy('id', 'desc');
        }
        
        if (@$request->allActivities == "true") {
            // echo "activity count - " .$activities->count();
            if ($activities->count() > $activities_pager) {
                $take = $activities->count() - $activities_pager;
                $activities = $activities->skip($activities_pager)->take($take)->paginate(20);
            } else {
                $activities = $activities->get();
                $shouldAppend = false;
            }

        }else if(isset($request->page)){
            $activities = $activities->paginate(20);
        }else if (@$request->allActivities == "false") {
            $isThereMoreActivities = $activities->count() > $activities_pager;
            $activities = $activities->take($activities_pager)->get();
            // $activities = $activities->skip( 20 * intval(@$request->activities_index) )->take(20)->get();
        }


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
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']</small>
                                      <strong>' . (is_null(@$ac->user->name) ? 'Admin' : @$ac->user->name) . '</strong> Created a new Job <a href="' . url(@$job->company->slug . '/job/' . $job->id . '/' . str_slug($job->title)) . '"><strong>' . $job->title . '</strong>.
                                  </p>
                                </li>';
                    break;
                case "APPLIED":

                    if (!is_null($ac->application)) {
                    $applicant = $ac->application->cv;
                    $job = $ac->application->job;
                    $content .= '<li role="candidate-application" class="list-group-item">

                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-edit fa-stack-1x fa-inverse"></i>
                                  </span>

                                  <h5 class="no-margin text-info">Job Application</h5>
                                  <p>
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']</small>
                                      <a href="' . url('applicant/activities/' . $ac->application->id) . '" target="_blank">' . @$applicant->first_name . ' ' . @$applicant->last_name . '</a> applied for <strong><a href="' . url('job/candidates/' . $ac->application->job->id) . '" target="_blank">' . $job->title . '</a></strong>
                                  </p>
                                </li>';
                    }

                    break;
                /*case "SHORTLISTED":
               $applicant = $ac->application->cv;
                   $content .= '<li role="candidate-application" class="list-group-item">

                               <span class="fa-stack fa-lg i-notify">
                                  <i class="fa fa-circle fa-stack-2x text-info"></i>
                                  <i class="fa fa-filter fa-stack-1x fa-inverse"></i>
                                </span>

                                <h5 class="no-margin text-info">Shortlist</h5>
                                <p>
                                    <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small>
                                    <a href="'. url('applicant/activities/'.$ac->application->id)  .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been shortlisted by <strong>'.( is_null( @$ac->user->name ) ? 'Admin' : @$ac->user->name ).'</strong>.
                                </p>
                              </li>';
                   continue;*/

                /*case "ASSESSED":
               $applicant = $ac->application->cv;
                   $content .= '<li role="candidate-application" class="list-group-item">

                               <span class="fa-stack fa-lg i-notify">
                                  <i class="fa fa-circle fa-stack-2x text-info"></i>
                                  <i class="fa fa-question-circle-o fa-stack-1x fa-inverse"></i>
                                </span>

                                <h5 class="no-margin text-info">Test</h5>
                                <p>
                                    <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small>
                                    <a href="'. url('applicant/activities/'.$ac->application->id) .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been scheduled for test by <strong>'.( is_null( @$ac->user->name ) ? 'Admin' : @$ac->user->name ).'</strong>.
                                </p>
                              </li>';
                   continue;*/

                case "TEST_ORDER":

                    if (!is_null($ac->application)) {
                    $applicant = $ac->application->cv;
                    $content .= '<li role="candidate-application" class="list-group-item">

                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-question-circle-o fa-stack-1x fa-inverse"></i>
                                  </span>

                                  <h5 class="no-margin text-info">Test</h5>
                                  <p>
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']</small>
                                      A test as been ordered <a href="' . url('applicant/activities/' . $ac->application->id) . '" target="_blank">' . $applicant->first_name . ' ' . $applicant->last_name . '</a>.
                                  </p>
                                </li>';
                    }
                    break;

                case "TEST_RESULT":

                    if (!is_null($ac->application)) {

                    $applicant = $ac->application->cv;
                    $content .= '<li role="candidate-application" class="list-group-item">

                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-question-circle-o fa-stack-1x fa-inverse"></i>
                                  </span>

                                  <h5 class="no-margin text-info">Test</h5>
                                  <p>
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']</small>
                                      <a href="' . url('applicant/activities/' . $ac->application->id) . '" target="_blank">' . $applicant->first_name . ' ' . $applicant->last_name . '</a>\'s test result has been sent.
                                  </p>
                                </li>';
                    }
                    break;

                case "PENDING":

                    if (!is_null($ac->application)) {
                    $applicant = $ac->application->cv;
                    $content .= '<li role="candidate-application" class="list-group-item">

                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-reply-all fa-stack-1x fa-inverse"></i>
                                  </span>

                                  <h5 class="no-margin text-info">Return to all</h5>
                                  <p>
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']</small>
                                      <a href="' . url('applicant/activities/' . $ac->application->id) . '" target="_blank">' . $applicant->first_name . ' ' . $applicant->last_name . '</a> has been returned to all by <strong>' . (is_null(@$ac->user->name) ? 'Admin' : @$ac->user->name) . '</strong>.
                                  </p>
                                </li>';
                    }
                    break;

                /*case "INTERVIEWED":
             $applicant = $ac->application->cv;
                 $content .= '<li role="candidate-application" class="list-group-item">

                             <span class="fa-stack fa-lg i-notify">
                                <i class="fa fa-circle fa-stack-2x text-info"></i>
                                <i class="fa fa-thumbs-o-up fa-stack-1x fa-inverse"></i>
                              </span>

                              <h5 class="no-margin text-info">Interview</h5>
                              <p>
                                  <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small>
                                  <a href="'. url('applicant/activities/'.$ac->application->id) .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been interviewed by <strong>'.( is_null( @$ac->user->name ) ? 'Admin' : @$ac->user->name ).'</strong>.
                              </p>
                            </li>';
                 break;*/


                /*case "HIRED":
                $applicant = $ac->application->cv;
                    $content .= '<li role="candidate-application" class="list-group-item">

                                <span class="fa-stack fa-lg i-notify">
                                   <i class="fa fa-circle fa-stack-2x text-info"></i>
                                   <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                 </span>

                                 <h5 class="no-margin text-info">Hired</h5>
                                 <p>
                                     <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small>
                                     <a href="'. url('applicant/activities/'.$ac->application->id) .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been hired by <strong>'.( is_null( @$ac->user->name ) ? 'Admin' : @$ac->user->name ).'</strong>.
                                 </p>
                               </li>';
                    break;*/

                /*case "WAITING":
               $applicant = $ac->application->cv;
                   $content .= '<li role="candidate-application" class="list-group-item">

                               <span class="fa-stack fa-lg i-notify">
                                  <i class="fa fa-circle fa-stack-2x text-info"></i>
                                  <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                </span>

                                <h5 class="no-margin text-info">Waiting</h5>
                                <p>
                                    <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small>
                                    <a href="'. url('applicant/activities/'.$ac->application->id) .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> has been added to the waiting list by <strong>'.( is_null( @$ac->user->name ) ? 'Admin' : @$ac->user->name ).'</strong>.
                                </p>
                              </li>';
                   break;*/

                /*case "REJECTED":
                   $applicant = $ac->application->cv;

                   $content .= '<li role="warning-notifications" class="list-group-item">

                                <span class="fa-stack fa-lg i-notify">
                                   <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                   <i class="fa fa-user-times fa-stack-1x fa-inverse"></i>
                                 </span>

                                 <h5 class="no-margin text-danger">Reject</h5>
                                 <p>
                                     <small class="text-muted pull-right">['.  date('D, j-n-Y, h:i A', strtotime($ac->created_at)) .']</small>
                                     <a href="'. url('applicant/activities/'.$ac->application->id) .'" target="_blank">'.$applicant->first_name.' '.$applicant->last_name.'</a> application was rejected by <a href="'. url('applicant/messages/'.$ac->application->id) .'" target="_blank"><strong>'.( is_null( @$ac->user->name ) ? 'Admin' : @$ac->user->name ).'</strong></a>
                                 </p>
                               </li>';
                    break;*/
                case "COMMENT":

                    if (!is_null($ac->application)) {
                    $applicant = $ac->application->cv;

                    $content .= '<li role="messaging" class="list-group-item">

                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                                  </span>

                                  <h5 class="no-margin text-success">Comment</h5>
                                  <p>
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']
                                      </small> ' . (is_null(@$ac->user->name) ? 'Admin' : @$ac->user->name) . ' said ' . $ac->comment . ' about <a href="' . url('applicant/activities/' . $ac->application->id) . '" target="_blank"><strong>' . $applicant->first_name . ' ' . $applicant->last_name . '</strong></a>
                                  </p>

                                </li>';
                    }
                    break;

                case "REVIEW":

                    if (!is_null($ac->application)) {
                    $applicant = $ac->application->cv;


                    $content .= '<li role="messaging" class="list-group-item">

                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                                  </span>

                                  <h5 class="no-margin text-success">Comment</h5>
                                  <p>
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']
                                      </small> ' . (is_null(@$ac->user->name) ? 'Admin' : @$ac->user->name) . ' commented <span style="display:none;" id="show_activity_comment">"' . $ac->comment . '"</span> on <a href="' . url('applicant/activities/' . $ac->application->id) . '" target="_blank"><strong>' . $applicant->first_name . ' ' . $applicant->last_name . '</strong></a>
                                  </p>

                                </li>';
                    }
                    break;

                case "SUSPEND-JOB":


                    $content .= '<li role="messaging" class="list-group-item">

                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-ban fa-stack-1x fa-inverse"></i>
                                  </span>

                                  <h5 class="no-margin text-success">Suspend Job</h5>
                                  <p>
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']</small>
                                      <strong>' . (is_null(@$ac->user->name) ? 'Admin' : @$ac->user->name) . '</strong> suspended <a href="#">' . $ac->job->title . '</a> job
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
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']</small>
                                      <strong>' . (is_null(@$ac->user->name) ? 'Admin' : @$ac->user->name) . '</strong> published <a href="#">' . $ac->job->title . '</a> job
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
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']</small>
                                      <strong>' . (is_null(@$ac->user->name) ? 'Admin' : @$ac->user->name) . '</strong> added a new Team member.
                                  </p>

                                </li>';
                    break;

                default:
                $status_type = $type;

                    if (!is_null($ac->application)) {
                    $applicant = $ac->application->cv;
                    $content .= '<li role="candidate-application" class="list-group-item">

                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                  </span>

                                  <h5 class="no-margin text-info">' . @$status_type . '</h5>
                                  <p>
                                      <small class="text-muted pull-right">[' . date('D, j-n-Y, h:i A', strtotime($ac->created_at)) . ']</small>
                                      <a href="' . url('applicant/activities/' . $ac->application->id) . '" target="_blank">' . $applicant->first_name . ' ' . $applicant->last_name . '</a> has been moved to <strong>' . @$status_type . '</strong> by <strong>' . (is_null(@$ac->user->name) ? 'Admin' : @$ac->user->name) . '</strong>.
                                  </p>
                                </li>';
                    }
            }

        }


        $content .= '</ul>';

        if ((@$request->allActivities == "true" && $request->type == 'dashboard') || isset($request->page)){
            $content .= $activities->links('vendor.pagination.simple-default');
        }

        if (count($activities) == 0) {
            $content = '<div class="row">
                            <div class="col-xs-12">
                                <h5 class="text-center text-success text-brandon">You have no activities yet</h5>
                            </div>
                        </div>';
        }

        return response()->json(["content" => $content, "shouldAppend" => $shouldAppend, "isThereMoreActivities" => $isThereMoreActivities ]) ;
    }

    public function JobActivities($id, Request $request)
    {
        $job = Job::with(['workflow.workflowSteps' => function ($q) {
            return $q->orderBy('order', 'asc');
        }])->find($id);

        //Check if he  is the owner of the job
        check_if_job_owner($id);

        $active_tab = 'activities';

        $result = SolrPackage::get_applicants($this->search_params, $id, '');



        $application_statuses = get_application_statuses($result['facet_counts']['facet_fields']['application_status'], $id, $job->workflow->workflowSteps()->pluck('slug'));

        $applicant_funnel = [];
        $funnel_cummulative = 0;


        foreach ($job->workflow->workflowSteps as $key => $step) {
            if ($step->slug != "ALL") {
                $funnel_cummulative = $application_statuses[$step->slug];
                $applicant_funnel[] = "['" . $step->name . "'," . $funnel_cummulative . "]";
            }
        }

        $applicant_funnel = implode(',', $applicant_funnel);


        $applications = JobApplication::where('job_id', $id)->select("created", DB::raw("DATE_FORMAT(created, '%d-%c-%Y') as created"))->orderBy('created', 'asc')->get()->groupBy('created')->take(10)->toArray();
        //"cust.*", DB::raw("DATE_FORMAT(cust.cust_dob, '%d-%b-%Y') as formatted_dob")

        $applications = array_map(function ($value) {
            return count($value);
        }, $applications);


        return view('job.board.activities', compact('job', 'active_tab', 'result', 'application_statuses', 'applications', 'applicant_funnel', 'applications'));
    }

    public function JobCandidates($id, Request $request)
    {
        $job = Job::find($id);
        $active_tab = 'candidates';

        //Check if he  is the owner of the job
        check_if_job_owner($id);

        return view('job.board.candidates', compact('job', 'active_tab'));
    }

    public function JobMatching($id, Request $request)
    {
        $job = Job::find($id);
        $active_tab = 'matching';

        $result = SolrPackage::get_applicants($this->search_params, $id, '');

        $application_statuses = get_application_statuses($result['facet_counts']['facet_fields']['application_status'], $id);


        return view('job.board.matching', compact('job', 'active_tab', 'result', 'application_statuses'));
    }


    public function saveCVPreview($cv)
    {

    }

    /**
     * Show a preview of a job detail
     * @param $c_url
     * @param $jobid
     * @param $job_slug
     * @param Request|null $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function JobViewOld($c_url, $jobid, $job_slug, Request $request = null)
    {
        return redirect()->route('job-view', ['jobID' => $jobid, 'jobSlug' => str_slug($job_slug)]);
    }

	/**
	 * Show a preview of a job detail
	 * @param $jobid
	 * @param $job_slug
	 * @param Request|null $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function JobView($jobid, $job_slug, Request $request = null)
    {

        $job = Job::with('company')->where('id', $jobid)->first();

        if (empty($job) || is_null($job)) {
            abort(404);
        }

        $company = $job->company;
        $company->logo = get_company_logo($company->logo);

        if (Carbon::now()->diffInDays(Carbon::parse($job->expiry_date), false) < 0 || in_array($job->status, ['SUSPENDED', 'DELETED'])) {
            $closed = true;
        } else {
            $closed = false;
        }
	    $privacy_policy = $this->settings->getWithoutPluck(Configs::PRIVACY_KEY);
        
        if(auth()->guard('candidate')->check()){

            $candidate = auth()->guard('candidate')->user();
            $application = "Candidate Viewed Job(Candidate)";
            mixPanelRecord($application, $candidate);
        }

	    return view('job.job-details', compact('job', 'company', 'closed', 'privacy_policy'));

    }


    public function jobShare($jobid, $job_slug, Request $request = null)
    {

        $job = Job::with('company')->where('id', $jobid)->first();

        if (empty($job) || is_null($job)) {
            abort(404);
        }
        $company = $job->company;
        $company->logo = get_company_logo($company->logo);

        $closed = false;
        $privacy_policy = $this->settings->getWithoutPluck(Configs::PRIVACY_KEY);

        return view('job.job-details', compact('job', 'company', 'closed','privacy_policy'));
    }


    public function correctHighestQualification()
    {


        // $j = Cv::where('id','>',4157)->get();

        Cv::where('highest_qualification', 10)->chunk(50, function ($cvs) {

            $qualifications = $this->qualifications;

            foreach ($cvs as $cv) {
                // echo $cv->highest_qualification."<br />";
                $cv->highest_qualification = $qualifications[$cv->highest_qualification];
                $cv->save();
            }
        });


    }

    public function jobApply($jobID, $slug, Request $request)
    {
        if (!Auth::guard('candidate')->check()) {
            return redirect()->route('candidate-login', ['redirect_to' => url()->current()]);
        }

        $candidate = Auth::guard('candidate')->user();

        $job = Job::with('company')->where('id', $jobID)->first();

        if($job->is_private && $candidate){
            
            $checkEmail = PrivateJob::with('job')->where('attached_email', $candidate->email)->first();
            
            if (empty($checkEmail) || is_null($checkEmail)) {
    
                $notPrivateCandidate = "Candidate was not attached to the private job (Candidate)";
                mixPanelRecord($notPrivateCandidate, $candidate);
                return redirect()->to('/candidate/dashboard')->with('error','You are not listed to apply for this job');
            }
        }

        $candidate_cvs = CV::where('email', $candidate->email)->pluck('id');

        $candidate_applied_jobs = JobApplication::whereIn('cv_id', $candidate_cvs)->where(
            'job_id', $job->id
        )->count();

        if ($candidate_applied_jobs > 0) {
            $oldCandidate = "Candidate has applied for the job previously (Candidate)";
            mixPanelRecord($oldCandidate, $candidate);
            return redirect()->to('/candidate/dashboard')->with('error','You have already applied for this job');
        }

        $company = $job->company;
        $specializations = Specialization::get();

        if (empty($job)) {
            abort(404);
        }

        $candidate = $candidate ?? Candidate::find(Auth::guard('candidate')->user()->id);

        if($candidate->is_from == 'external' && $job->is_for == 'internal')
        {
            $externalCandidate = "Job is for internal candidate only(Candidate)";
            mixPanelRecord($externalCandidate, $candidate);
            return redirect()->route('candidate-dashboard')
            ->withErrors(['warning' => 'You can not apply for this job, It is meant for Internal candidate']);
        }

        // disavow internal staff from applying to external jobs
        if ($job->is_for == 'external' && $candidate->company_id == $company->id) {
            $internalCandidate = "Job is for external candidate only(Candidate)";
            mixPanelRecord($internalCandidate, $candidate);
            return redirect()->route('candidate-dashboard')
                ->withErrors(['warning' => 'You can not apply for this job, It is meant for external candidate']);
        }

        $qualifications = $this->qualifications;
        $grades = grades();

        $states = $this->states;
        $countries = countries();

        $custom_fields = (object)$job->form_fields()->where('is_visible', 1)->get();
        $fields = json_decode($job->fields);

        if ($request->isMethod('post')) {

            $data = $request->all();

            $data['first_name'] = $data['first_name'] ?? $candidate->first_name;
            $data['last_name'] = $data['last_name'] ?? $candidate->last_name;
            $data['email'] = $data['email'] ?? $candidate->email;

            $owned_applications_count = JobApplication::where('candidate_id', $candidate->id)->where('job_id', $jobID)->count();

            if ($owned_applications_count > 0) {
                return redirect()->route('job-applied', [$jobID, $slug, true]);
            }
            //validate if request has cv_file or cv_file is a required field
            if ($request->hasFile('cv_file') || $fields->cv_file->is_required) {

                if($fields->cv_file->is_required){
                    $this->validate($request, [
                        'cv_file' => 'required',
                    ],
                    $message =[
                        'cv_file.required' => 'No CV file was attached'
                    ]
                );
                }
                \Log::info(json_encode($request->file('cv_file')));
                \Log::info(json_encode($request->email.'cv file size....'.$request->file('cv_file')->getSize()));

                if ($request->file('cv_file')->getSize()  < 1 || !in_array($request->file('cv_file')->getClientOriginalExtension(),['pdf','doc','docx']) ) {
                    return back()->withErrors(['warning' => 'Invalid CV file. Please check and try again.']);
                }

                $filename = time() . '_' . str_slug($request->email) . '_' . $request->file('cv_file')->getClientOriginalName();

                $data['cv_file'] = $filename;
            } else {
                $data['cv_file'] = null;
            }




            if ($request->hasFile('optional_attachment_1')) {

                if ($request->file('optional_attachment_1')->getSize()  < 1 || !in_array($request->file('optional_attachment_1')->getClientOriginalExtension(),['pdf','doc','docx']) ) {
                    return back()->withErrors(['warning' => 'Invalid Optional attachment. Please check and try again.']);
                }

                $filename = time() . '_' . str_slug($request->email) . '_' . $request->file('optional_attachment_1')->getClientOriginalName();

                $data['optional_attachment_1'] = $filename;
            } else {
                $data['optional_attachment_1'] = null;
            }

            if ($request->hasFile('optional_attachment_2')) {

                if ($request->file('optional_attachment_2')->getSize()  < 1 || !in_array($request->file('optional_attachment_2')->getClientOriginalExtension(),['pdf','doc','docx'])) {
                    return back()->withErrors(['warning' => 'Invalid Optional attachment. Please check and try again.']);
                }

                $filename = time() . '_' . str_slug($request->email) . '_' . $request->file('optional_attachment_2')->getClientOriginalName();

                $data['optional_attachment_2'] = $filename;
            } else {
                $data['optional_attachment_2'] = null;
            }

            if ($fields->date_of_birth->is_visible && isset($data['date_of_birth'])) {
                $data['date_of_birth'] = date('Y-m-d', strtotime($data['date_of_birth']));
            }

            if ($fields->willing_to_relocate->is_visible && isset($data['willing_to_relocate'])) {
                if ($data['willing_to_relocate'] == 'yes') {
                    $data['willing_to_relocate'] = true;
                }
            }

            if ($fields->state_of_origin->is_visible && (isset($data['location']) || isset($data['country']))) {

                if ($data['location'] != "") {
                    $location_value = ($request->country != 'Nigeria') ? $request->country :
                        ( ($request->location == 'Across Nigeria') ? 'Nigeria' : $request->location);

                    $data['state_of_origin'] = $location_value;
                }

            }

            if ($fields->location->is_visible && (isset($data['location']) || isset($data['country']))) {

                if ($data['location'] != "") {
                    $location_value = ($request->country != 'Nigeria') ? $request->country :
                        ( ($request->location == 'Across Nigeria') ? 'Nigeria' : $request->location);

                    $data['location'] = $location_value;
                }

            }

            if (isset($fields->completed_nysc->is_visible) && $fields->completed_nysc->is_visible && (isset($data['completed_nysc']))) {

                if ($data['completed_nysc'] == 'yes') {
                    $nysc = 1;
                }else{
                    $nysc = 0;
                }

            }

            if (isset($fields->school->is_visible) && $fields->school->is_visible && (isset($data['school']))) {

                if($data['school']=='others'){
                    $school = School::FirstOrCreate([
                        'name' => $data['others']
                    ]);
                }
            
                $school_id = isset($data['others']) && isset($school) ? $school->id : $data['school'];
            }

            if (isset($fields->remuneration->is_visible) && $fields->remuneration->is_visible && (isset($data['maximum_renumeration'])) &&  (isset($data['minimum_renumeration']))) {

                if ($request->maximum_remuneration <= $request->minimum_remuneration ) {
                    
                    return back()->withErrors(['warning' => 'Maximum Remuneration cannot be less than Minimum Renumeration.']);
                }
            }
            
            if (count($custom_fields) > 0) {
                foreach ($custom_fields as $custom_field) {
                    $name = 'cf_' . str_slug($custom_field->name, '_');
                    $attr = $custom_field->name;
                    $field_type = $custom_field->type;
                    $required = $custom_field->is_required;
                    
                    if($required){
                        $validate = validateCustomFields($name,$attr,$field_type, $required,$request);
                        $validate->validate(); 
                    }
                    if($request->hasFile("$name") && $field_type == "FILE"){
                        if ($request->file("$name")->getSize()  < 1 || !in_array($request->file("$name")->getClientOriginalExtension(),['pdf','doc','docx']) ) {
                            return redirect()->back()->withInput()->withErrors(['warning' => "Invalid file was attached. Please check and try again."]);
                        }
                    }
                    
                }

            }
            
            $data['created'] = date('Y-m-d H:i:s');
            $data['action_date'] = date('Y-m-d H:i:s');


            //saving cv...
            $cv = new Cv;

            $cv->first_name = $data['first_name'] ?? null;
            $cv->last_name = $data['last_name'] ?? null;
            $cv->email = $data['email'] ?? null;
            $cv->phone = $data['phone'] ?? null;
            
            if ($fields->cover_note->is_visible && isset($data['cover_note'])) {
                $cv->headline = $data['cover_note'];
            }

            if ($fields->gender->is_visible && isset($data['gender'])) {
                $cv->gender = $data['gender'];
            }
            if ($fields->date_of_birth->is_visible && isset($data['date_of_birth'])) {
                $dob = !empty($request->date_of_birth) ? $data['date_of_birth'] : null;
                $cv->date_of_birth = $dob;
            }
            if ($fields->marital_status->is_visible && isset($data['marital_status'])) {
                $cv->marital_status = $data['marital_status'];
            }

            if ($fields->location->is_visible && (isset($data['location']) || isset($data['country']))) {
                $location_value = ($request->country != 'Nigeria') ? $request->country :
                    ( ($request->location == 'Across Nigeria') ? 'Nigeria' : $request->location);

                $cv->state = $location_value;
            }
            if ($fields->highest_qualification->is_visible && isset($data['highest_qualification'])) {
                if ($data['highest_qualification'] != "") {
                    $cv->highest_qualification = $qualifications[$data['highest_qualification']];
                }

            }
            if ($fields->last_position->is_visible && isset($data['last_position'])) {
                $cv->last_position = $data['last_position'];
            }
            if ($fields->last_company_worked->is_visible && isset($data['last_company_worked'])) {
                $cv->last_company_worked = $data['last_company_worked'];
            }
            if ($fields->years_of_experience->is_visible && isset($data['years_of_experience'])) {
                $cv->years_of_experience = $data['years_of_experience'];
            }
            if ($fields->graduation_grade->is_visible && isset($data['graduation_grade'])) {
                $cv->graduation_grade = $data['graduation_grade'];
            }
            if (isset($fields->school->is_visible) && $fields->school->is_visible && isset($data['school'])) {
                $cv->school_id = $school_id;
            }
            if (isset($fields->course_of_study->is_visible) && $fields->course_of_study->is_visible && isset($data['course_of_study'])) {
                $cv->course_of_study = $data['course_of_study'];
            }
            if (isset($fields->completed_nysc->is_visible) && $fields->completed_nysc->is_visible && isset($data['completed_nysc'])) {
                $cv->completed_nysc = $nysc;
            }
            if ($fields->willing_to_relocate->is_visible && isset($data['willing_to_relocate'])) {
                $cv->willing_to_relocate = $data['willing_to_relocate'];
            }
            if ($fields->cv_file->is_visible && isset($data['cv_file'])) {
                $cv->cv_file = $data['cv_file'];
            }
            if (isset($fields->remuneration->is_visible) && $fields->remuneration->is_visible && isset($data['maximum_remuneration']) && isset($data['minimum_remuneration'])) {
                $cv->minimum_remuneration = $data['minimum_remuneration'];
                $cv->maximum_remuneration = $data['maximum_remuneration'];
            }

            if ($fields->state_of_origin->is_visible && (isset($data['location']) || isset($data['country']))) {
                $location_value = ($request->country != 'Nigeria') ? $request->country :
                    ( ($request->location == 'Across Nigeria') ? 'Nigeria' : $request->location);

                $cv->state_of_origin = $location_value;
            }



            $cv->candidate_id = $candidate->id;
            $cv->optional_attachment_1 = $data['optional_attachment_1'] ?? null;
            $cv->optional_attachment_2 = $data['optional_attachment_2'] ?? null;
            $cv->applicant_type = $data['applicant_type'] ?? null;
            $cv->save();

            $cvExt = new CvSalesController();
            $cvExt->ExtractCv($cv);

            //saving job application...
            $appl = new JobApplication;

            if ($fields->cover_note->is_visible && isset($data['cover_note'])) {
                $appl->cover_note = $data['cover_note'];
            }

            $appl->cv_id = $cv->id;
            $appl->job_id = $job->id;
            $appl->status = 'PENDING';
            $appl->created = $data['created'] ?? null;
            $appl->action_date = $data['action_date'] ?? null;
            $appl->candidate_id = $candidate->id;
            $appl->save();

            if ($request->specializations) {
                foreach ($request->specializations as $e) {
                    $cv->specializations()->attach($e);
                }
            }

            $appl_activities = (save_activities('APPLIED', $jobID, $appl->id, ''));

            if (count($custom_fields) > 0) {

                $custom_field_values = [];

                foreach ($custom_fields as $custom_field) {
                    $value = '';
                    if ($custom_field->type == "FILE") {
                        $name = 'cf_' . str_slug($custom_field->name, '_');
                        if ($request->hasFile($name)) {

                            $filename = time() . '_' . str_slug($request->email) . '_' . $request->file($name)->getClientOriginalName();
                            $destinationPath = env('fileupload','uploads') . '/Others';
                            findOrMakeDirectory($destinationPath);

                            $request->file($name)->move($destinationPath, $filename);

                            $value = $filename;
                        }
                    } else if ($custom_field->type == 'MULTIPLE_OPTION') {
                        $value = implode(',', $request['cf_' . str_slug($custom_field->name, '_')]);
                    } else if ($custom_field->type == 'CHECKBOX') {
                        $value = implode(',', $request['cf_' . str_slug($custom_field->name, '_')]);
                    } else {
                        $value = $request['cf_' . str_slug($custom_field->name, '_')];
                    }

                    $custom_field_values[] = [
                        'form_field_id' => $custom_field->id,
                        'value' => $value,
                        'job_application_id' => @$appl->id
                    ];
                }

                FormFieldValues::insert($custom_field_values);
            }


            if ($request->hasFile('cv_file')) {
                $destinationPath = env('fileupload') . '/CVs';
                findOrMakeDirectory($destinationPath);
                $request->file('cv_file')->move($destinationPath, $data['cv_file']);

            }

            if ($request->hasFile('optional_attachment_1')) {
                $destinationPath = env('fileupload') . '/CVs';
                findOrMakeDirectory($destinationPath);
                $request->file('optional_attachment_1')->move($destinationPath, $data['optional_attachment_1']);
            }
            if ($request->hasFile('optional_attachment_2')) {
                $destinationPath = env('fileupload') . '/CVs';
                findOrMakeDirectory($destinationPath);
                $request->file('optional_attachment_2')->move($destinationPath, $data['optional_attachment_2']);
            }


            if ($job->video_posting_enabled) {
                return redirect()->route('job-video-application', ['jobid' => $jobID, 'slug' => $slug, 'appl_id' => $appl->id]);

            }

            Mail::send('emails.new.job_application_successful', ['user' => $candidate, 'link' => route('candidate-dashboard'), 'job' => $job], function (Message $m) use ($candidate) {
                $m->from(env('COMPANY_EMAIL'))->to($candidate->email)->subject('Job Application Successful');
            });

            try {
                $job_application = JobApplication::with('cv')->find($appl->id);
                UploadApplicant::dispatch($job_application)->onQueue('solr');
            } catch (Exception $e) {
                Log::info(json_encode($e));
            }

            $application = "Candidate Job Application was Successful(Candidate)";
            mixPanelRecord($application, $candidate);

            return redirect()->route('job-applied', [$jobID, $slug]);

        }


        $company->logo = get_company_logo($company->logo);

        $last_cv = Cv::where('candidate_id', $candidate->id);
        if ($last_cv->count()) {
            $last_cv = $last_cv->orderBy('id', 'desc')->first();
        } else {
            $last_cv = [];
        }


        $google_captcha_attributes = [
            'data-theme' => 'light',
            'data-type' => 'audio',
        ];

        $fromShareURL = false;

        $referer_url = (request()->headers->get('referer'));

        if(Str::contains($referer_url, 'job/share'))
                $fromShareURL = true;

        $privacy_policy = $this->settings->getWithoutPluck(Configs::PRIVACY_KEY);
        
        $application = "Candidate Opened Job Application Form(Candidate)";
        mixPanelRecord($application, $candidate);

	    return view('job.job-apply', compact('job', 'qualifications', 'states', 'company',
		    'specializations', 'grades', 'custom_fields', 'google_captcha_attributes', 'fromShareURL', 'candidate',
		    'last_cv', 'fields','countries','privacy_policy'));

    }

    public function JobVideoApplication($jobID, $job_slug, $appl_id, Request $request)
    {
        $job = Job::with('company')->where('id', $jobID)->first();
        $company = $job->company;
        $company->logo = get_company_logo($company->logo);

        $video_options = VideoApplicationOptions::where('job_id', $jobID)->get();

        if ($request->isMethod('post')) {

            $video_application_values = [];
            $score = 0;
            $correct_count = 0;
            foreach ($video_options as $key => $option) {
                //$request->all()

                $video_application_values[] = [
                    'form_field_id' => $option->id,
                    'value' => $request['vo_' . $option->id],
                    'job_application_id' => @$appl_id
                ];

                if ($option->correct_option == $request['vo_' . $option->id]) {
                    $correct_count++;
                }

            }

            $score = ($correct_count / count($video_options)) * 100;

            VideoApplicationValues::insert($video_application_values);


            $app = JobApplication::find($appl_id);
            $app->video_application_score = $score;
            $app->save();

            return redirect()->route('job-applied', [$jobID, $job_slug]);
        }

        return view('job.video-application', compact('job', 'company', 'video_options'));
    }

    public function JobApplied($jobID, $job_slug, Request $request)
    {
        $job = Job::with('company')->where('id', $jobID)->first();
        $company = $job->company;
        @$already_applied = $request->already_applied;

        if (empty($job)) {
            // redirect to 404 page
        }

        $response = Curl::to('https://api.insidify.com/articles/get-posts')
            ->withData(array('limit' => 6))
            ->post();

        $posts = @json_decode($response)->data->posts;


        return view('job.applied', compact('job', 'company', 'posts', 'already_applied'));

    }


    public function company($slug)
    {

        $company = Company::where('slug', $slug)->first();
        if (empty($company) || is_null($company)) {
            abort(404);
        }
        $jobs = Job::where('company_id', $company->id)
            ->where('status', "ACTIVE")
            ->where('expiry_date', '>', date('Y-m-d'))
            ->where(function ($q) use ($company) { // fetch both internal and external jobs to show on staffstrength
                $q->where('is_for', 'external');
                $q->orWhere('is_for', 'both');
                if (Auth::guard('candidate')->check()) {
                    if (Auth::guard('candidate')->user()->company_id == $company->id) {
                        $q->orWhere('is_for', 'internal');
                    }

                }
            })->orderBy('created_at', 'desc')
            ->get();

        $company->logo = get_company_logo(@$company->logo);

        $domain_url = url('/').'/js/embed.js';


        if (Auth::check()) {
            $embed = "<div id='SH_Embed'></div><script src='".$domain_url."'></script><script type='text/javascript'>document.getElementById('SH_Embed').innerHTML = SH_Embed.pull({key : '" . Crypt::encrypt(Auth::user()->id . "~&" . Auth::user()->email . "~&" . Auth::user()->created_at . "~&" . $company->id) . "'});</script>";
        } else {
            $embed = "";
        }

        return view('job.company', compact('company', 'jobs', 'embed'));

    }


    public function accountExpired($c_url)
    {

        $company = Company::with(['jobs' => function ($query) {
            $query->where('status', "ACTIVE")
                ->orderBy('created_at', 'desc')
                ->where('expiry_date', '>', date('Y-m-d'));
        }])->where('slug', $c_url)->first();

        // $company->jobs()->orderBy('created_at','desc')->get()->toArray();


            $company->logo = get_company_logo(@$company->logo);


        return view('job.account-expired', compact('company'));

    }


    public function MyCompany()
    {

        $user = Auth::user();
        $company = get_current_company();

        return redirect('/' . $company->slug);


    }

    public function Preview($job_id)
    {

        $job = Job::with('company')->find($job_id);

        return redirect('/' . $job->company->slug . '/job/' . $job->id . '/' . str_slug($job->title));


    }

    public function Ajax(Request $request)
    {

        $user = User::find($request->user_id);

        return view('job.ajax-team-edit', compact('user'));

    }

    public function EditJob(Request $request, $jobid)
    {

        $job = Job::with('company')->findOrFail($jobid);
        $locations = locations();
        $countries =countries();
        $qualifications = qualifications();
        if ($request->isMethod('post')) {
        if(is_null($request->country)){
             return redirect()->back()->with('errors','Country Cannot be empty')->withInput();
        }

			$this->validate($request, [
				'minimum_remuneration' => 'numeric|min:0',
				'maximum_remuneration' => 'numeric|min:0|gt:minimum_remuneration'
			], [
				'maximum_remuneration.gt' => 'maximum remuneration should be greater than minimum remuneration'
			]);


            $location_value = ($request->country != 'Nigeria') ? $request->country :
                ( ($request->job_location == 'Across Nigeria') ? 'Nigeria' : $request->job_location);

            $job->title = $request->title;
            $job->location = $location_value;
            $job->job_type = $request->job_type;
            $job->position = $request->position;
			$job->benefits = $request->benefits;
			$job->minimum_remuneration = $request->minimum_remuneration;
			$job->maximum_remuneration = $request->maximum_remuneration;
            // $job->post_date = $request->post_date;
            $job->expiry_date = Carbon::createFromFormat('Y-m-d', $request->expiry_date)->format("Y-m-d H:m:s");
            $job->details = $request->details;
            $private = ($request->is_private  == 'true' ? 1 : 0);
            $job->is_private = $private;
            $job->experience = $request->experience;

            //attach emails to private jobs
            if($request->is_private){

                if($request->attach_email){
                    $request->validate([
                        'attach_email' => ['nullable', new PrivateEmailRule],
                    ]);
                    $attached_emails = $request->attach_email;
                    $arr = explode(",",$attached_emails);

                    foreach ($arr as $value) {

                        PrivateJob::UpdateOrCreate(['job_id' => $job->id,'attached_email'=> $value]);
                    }
                        
                }
                
                if($request->hasFile('bulk')){
                    //bulk upload
                    $request->validate([
                        'bulk' => 'required|mimes:csv,txt'
                    ]);

                    $path = $request->file('bulk');
                    $headings = (new HeadingRowImport)->toArray($path);
                    $emails = $headings[0][0];
                    if (!in_array("emails", $emails)) {
                        return redirect()->back()->withInput()->withErrors(['Header row emails not found']);
                    }
                    $data = Excel::import(new PrivateJobEmail($job->id), $path);
                    
                }
                
            }

            $job->save();
            // $job->update($request->all());

            return redirect()->route('job-view', ['jobID' => $job->id, 'jobSlug' => str_slug($job->title)]);


        }


        return view('job.edit', compact('qualifications', 'job', 'locations','countries'));

    }

    public function JobStatus(Request $request)
    {

        $job = Job::find($request->job_id);

        $count = JobApplication::where('job_id', $request->job_id)->count();

            $res = Job::where('id', $request->job_id)
                ->update(['status' => $request->status]);

            if ($res)
                return "true";


    }

    public function makeJobPrivateOrPublic(Request $request)
    {
        $job = Job::find($request->job_id);
        $job->is_private =  $request->is_private == 'true' ? true : false;
        $job->save();
        if ($job)
            return "true";
    }

    public function ReferJob(Request $request)
    {

        if ($request->isMethod('post')) {

            $to = explode(',', $request->to);
            $job = Job::find($request->jobid);

            $mail = Mail::send('emails.cv-sales-invoice', ['job' => $job], function ($m) use ($to) {
                $m->from('hello@app.com', 'Your Application');

                $m->to($to)->subject('Your Reminder!');
            });

            if ($mail) {
                echo 'sent';
            } else {
                echo "error sending";
            }

        }
    }

    public function SimplePay(Request $request)
    {
        $job = Job::find($request->job_id);
        $company = get_current_company();
        $to = env('COMPANY_EMAIL');

        if ($request->type == 'JOB_BOARD') {
            $mail = Mail::send('emails.new.job-application', ['job' => $job, 'boards' => $request->boards, 'company' => $company], function ($m) use ($company, $to) {
                $m->from($to, @$company->name);

                $m->to($to)->subject('New Job initiated');
            });
        }


        $private_key = 'test_pr_bbe9d51b272e4a718b01d5c8eb7d2c1f';

        // Retrieve data returned in payment gateway callback
        // $token = $_POST["token"];
        $token = $request->token;
        $amount = $request->amount;
        $amount_currency = $request->currency;
        $sp_status = $request->status;
        $transaction_id = $request->rnd; // we don't really need this here, is just an example


        $data = array(
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
        $curl_response = preg_split("/\r\n\r\n/", $curl_response); //var_dump($curl_response); echo "<br><br><br>";
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
                Invoices::where('id', @$request->invoice_no)->update(['status' => 'PAID']);
                $invoice = Invoices::with('items')->where('id', @$request->invoice_no)->first();

                switch ($request->type) {
                    case 'JOB_BOARD':
                        $invoice_type = "JOB BOARDS";
                        break;

                    case 'BACKGROUND_CHECK':
                        $invoice_type = "BACKGROUND CHECKS";
                        break;

                    case 'MEDICAL_CHECK':
                        $invoice_type = "MEDICAL CHECKS";
                        break;

                    case 'TEST':
                        $invoice_type = "TESTS";
                        break;

                    default:
                        break;
                }


                $user = Auth::user();
                $mail = Mail::send('emails.new.successful_payment', compact('invoice', 'invoice_type', 'user', 'amount'), function ($m) use ($invoice, $invoice_type) {
                    $m->from(env('COMPANY_EMAIL'), 'Seamlesshiring');

                    // $m->to(env('COMPANY_EMAIL'))->subject('Customer Invoice: #'.$invoice->id);
                    $m->to(Auth::user()->email)->subject('Customer Invoice: #' . $invoice->id);
                });
                if ($request->type == 'JOB_BOARD') {

                    foreach ($request->boards as $key => $board) {
                        // $b = JobBoard::where('id',$board)->get();
                        $job->boards()->attach($board, ['url' => '']);

                        // job_board_id,url
                    }


                    $mail = Mail::send('emails.new.job-application', ['job' => $job, 'boards' => $request->boards, 'company' => $company], function ($m) use ($company, $to) {
                        $m->from($to, @$company->name);

                        $m->to($to)->subject('New Job Paid');
                    });


                    // $request->boards
                }

                if ($request->type == 'TEST') {
                    $this->approveTest($request->tests, $request->app_ids);
                }

                return "true";
            } else {
                // failed to charge the card
                return "false";
            }
        } else if ($sp_status == 'true') {
            // even though it failed the call to card charge, card payment was already processed
            Invoices::where('id', @$request->invoice_no)->update(['status' => 'PAID']);
            if ($request->type == 'JOB_BOARD') {

                foreach ($request->boards as $key => $board) {
                    // $b = JobBoard::where('id',$board)->get();
                    $job->boards()->attach($board, ['url' => '']);

                    // job_board_id,url
                }


                $mail = Mail::send('emails.new.job-application', ['job' => $job, 'boards' => $request->boards, 'company' => $company], function ($m) use ($company, $to) {
                    $m->from($to, @$company->name);

                    $m->to($to)->subject('New Job Paid');
                });


                // $request->boards
            }

            if ($request->type == 'TEST') {
                $this->approveTest($request->tests, $request->app_ids);
            }
            return "true";
        } else {
            // failed to charge the card
            return "false";
        }


    }

    private function approveTest($tests, $app_ids)
    {

        foreach ($tests as $key => $test) {


            foreach ($app_ids as $key => $app_id) {
                $data = [
                    'status' => 'PENDING'
                ];


                $query = TestRequest::where('job_application_id', $app_id)
                    ->where('test_id', $test['id']);

                $test = $query->get()->first()->toArray();

                $query->update($data);

                $app = JobApplication::with('cv', 'job')->find($app_id);

                JobApplication::massAction(@$request->job_id, @$request->cv_ids, $request->step, $request->stepId);

                $testUrl = env('SEAMLESS_TESTING_APP_URL').'/test-request';

                $data = [
                    'job_title' => $app->job->title,
                    'test_id' => $data['test_id'],
                    'job_application_id' => $app_id,
                    'applicant_name' => ucwords(@$app->cv->first_name . " " . @$app->cv->last_name),
                    'applicant_email' => $app->cv->email,
                    'employer_name' => get_current_company()->name,
                    'employer_email' => get_current_company()->email,
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time']
                ];

                $ch = curl_init($testUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                // execute!
                $response = curl_exec($ch);

                // close the connection, release resources used
                curl_close($ch);
            }

            // var_dump($data);
        }
    }

    public function SendJob(Request $request)
    {

        $job = Job::find($request->jobid);
        $to = $request->emails;

        $mail = Mail::send('emails.cv-sales-invoice', ['job' => $job], function ($m) use ($to) {
            $m->from('alerts@insidify.com', 'Your Application');

            $m->to($to)->subject('Job for you');
        });

        if ($mail) {
            echo 'Email has been sent successfully';
        } else {
            echo "Error sending, please try again in few minutes";
        }

    }

    public function SavetoMailbox(Request $request)
    {

        $user = Auth::user();
        $job = Job::find($request->jobid);
        $to = $user->email;

        $mail = Mail::send('emails.cv-sales-invoice', ['job' => $job], function ($m) use ($to) {
            $m->from('alerts@insidify.com', 'Your Application');

            $m->to($to)->subject('Job for you');
        });

        if ($mail) {
            echo 'Email has been sent successfully';
        } else {
            echo "Error sending, please try again in few minutes";
        }

    }

    public function DuplicateJob(Request $request)
    {
        $newJob = Job::find($request->job_id)->replicate();
        $newJob->save();
        $newJob->status = "DRAFT";
        $newJob->save();
        if ($newJob) {
            echo true;
        }
    }
    public function addCompany(Request $request)
    {

        if ($request->isMethod('post')) {


            $validator = Validator::make($request->all(), [
				'company_email' => 'required|unique:companies,email',
				'company_name' => 'required|unique:companies,name',
				'phone' => 'required',
				'about_company' => 'required',
				'website' => 'regex:/^https:\/\/\w+(\.\w+)*(:[0-9]+)?\/?$/',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            if (isset($request->logo)) {
                $file_name = ($request->logo->getClientOriginalName());
                $fi = $request->file('logo')->getClientOriginalExtension();
                $logo = $request->company_name . '-' . $file_name;
                $upload = $request->file('logo')->move(
                    'img', $logo
                );
            } else {
                $logo = "";
            }


            $comp = Company::FirstorCreate([
                'name' => $request->company_name,
                'email' => $request->company_email,
                'slug' => str_slug($request->company_name),
                'phone' => $request->phone,
                'website' => $request->website,
                'address' => $request->address,
                'about' => $request->about_company,
                'logo' => $logo,
                //'license_type'=>'PREMIUM',
                'date_added' => date('Y-m-d H:i:s'),
            ]);

            $assoc = DB::table('company_users')->insert([
                ['user_id' => Auth::user()->id, 'company_id' => $comp->id]
            ]);

            $tests = DB::table('company_tests')->insert([
                ['ats_product_id' => 23, 'company_id' => $comp->id],
                ['ats_product_id' => 24, 'company_id' => $comp->id],
                ['ats_product_id' => 25, 'company_id' => $comp->id],
                ['ats_product_id' => 27, 'company_id' => $comp->id]
            ]);

            $email_title = 'New Subsidiary Created on RMS for '.get_current_company()->name;
            $user = Auth::user();
            $subsidiary = $request->company_name;
            //mail to cs and sales
            $mail = Mail::send('emails.subsidiary.cs-sales-notify', compact('email_title','user', 'subsidiary'), function ($m) use ($email_title) {
                $m->from(env('COMPANY_EMAIL'))->to('support-team@seamlesshr.com')->cc('sales@seamlesshr.com')->subject($email_title);
            });
            
            Mail::send('emails.subsidiary.admin-notify', compact('email_title','user', 'subsidiary'), function ($m) use ($user, $email_title) {
                $m->from(env('COMPANY_EMAIL'))->to($user->email)->subject($email_title);
            });
            
            
            

            // if($upload){
            return redirect('select-company/' . str_slug($request->company_name));
            // }


        }
        return view('company.add');
    }
    public function editCompany(UpdateCompanyRequest $request)
	{
		$collect = collect($request);
		if (isset($request->logo)) {
                $file_name = ($request->logo->getClientOriginalName());
                $file_extension = $request->file('logo')->getClientOriginalExtension();
                $logo = str_slug($request->name) . '-' . $file_name;
                $upload = $request->file('logo')->move(
                    'img', $logo
                );
	            $collect['logo'] = $logo ;

            } else {
			   $collect['logo'] = "" ;
            }

	      seamlessSave(Configs::COMPANY_MODEL,  $collect->toArray(), $request->company_id);
            if ($request->company_creation_page) return back()->with('success', "Company updated successfully.");
          return redirect('company/subsidiaries')->with('success', "Subsidiary updated successfully.");
	}

    public function selectCompany(Request $request)
    {
        foreach (Auth::user()->companies as $key => $company) {
            if ($company->slug == $request->slug) {
                Session::put('current_company_index', $key);
                return redirect('dashboard');
            }
        }
    
    }

    public function embed()
    {
        $user = get_current_company()->users()->first();
        $key = Crypt::encrypt($user->id . '~&' . $user->email . '~&' . $user->created_at . '~&' . get_current_company()->id);

        $domain_url = url('/').'/js/embed.js';

        $base_url = url('/').'/';

        $embed_code = "<div id='SH_Embed'></div><script src='" .$domain_url. "'></script><script type='text/javascript'>document.getElementById('SH_Embed').innerHTML=SH_Embed.pull({key : '" . $key . "', base_url : '" . $base_url . "'});</script>";
        mixPanelRecord("Embed Page Accessed (Admin)", auth()->user());

        return view('settings.embed', compact('embed_code'));
    }

    public function getEmbedTest()
    {
        $key = Crypt::encrypt('20~&' . 'atolagbemobolaji@gmail.com~&' . '2016-05-27 16:20:10' . '~&13');



        return view('guest.embed-test', compact('key'));
    }

    public function getEmbed(Request $request)
    {
        // allow origin
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        // add any additional headers you need to support here
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With,X-Auth-Token, Origin');

        list($id, $email, $created_at, $company_id) = explode('~&', Crypt::decrypt($request->key));

        // var_dump($id, $email, $created_at);

        $user = User::with('companies')->whereHas('companies', function ($query) use ($company_id) {
            $query->where('company_id', $company_id);
        })
            ->where('id', $id)
            // ->where('email', $email."")
            ->where('created_at', $created_at)->first();



        if ($user->exists()) {
            $company = Company::find($company_id);
            $jobs = $company->jobs()->where('is_for','!=','internal')->whereStatus('ACTIVE')->orderBy('created_at', 'desc')->get()->toArray();
        } else {
            $company = null;
            $jobs = "Invalid Key";
        }
        return view('guest.embed-view', compact('jobs', 'user', 'company'));
    }

    /** Make staffs without roles admin
     * @return string
     */
    public function makeOldStaffsAdmin ()
    {

        $users = User::all ();
        $admin = Role::where ( 'name', 'admin' )->first ();

        foreach ( $users as $user ) {
            ( !$user->roles ()->exists () ) ? $user->roles ()->attach ( $admin->id ) : '';
        }
        return 'done';
    }

    public function manageRoles ( Request $request )
    {
        if ( $request->isMethod ( 'post' ) ) {
            $user = User::with('roles')->find($request->id);
            if (!is_null(env('STAFFSTRENGTH_URL')) || env('RMS_STAND_ALONE') ) {
                $user->update([
                    'is_super_admin' => $request->role
                ]);
                mixPanelRecord("Admin Role Updated successfully (Admin)", auth()->user());
                return response()->json (['status' => true]);
            } else {
                mixPanelRecord("Admin creation failed (Admin)", $user);
                return response()->json([
                    'status' => false,
                    'message' => "you have to manage super admins from HRMS"
                ]);
            }
        }
        $users = User::with('roles')->get();
        $roles = Role::get();
        return view ('admin.roles_management.index', compact ('users', 'roles'));
    }


    function searchForName($id, $array) {
       foreach ($array as $key => $val) {
           if ($val['name'] === $id) {
               return $key;
           }
       }
       return null;
    }

    /*
       * To delete a job team admin user
       * @return Illuminate\Http\Response
       */
    public function JobTeamDelete(Request $request){

        $data = [
            "user_id" => "required"
        ];

        $data = $request->validate($data);
        $user = User::find($data["user_id"]);
        if($user){
            if(isHrmsIntegrated()) {
                return redirect()->back()->with(['warning' => "You are synced with HRMS and can only delete a super admin from HRMS"]);
            }
            $data = $user;
            $user->delete();
            logAction([
                'log_name' => 'Job Team Admin Delete',
                'description' => 'An action that deletes a job team super admin',
                'action_type' => 'Delete',
                'causee_id' => $data->id,
                'causer_id' =>  Auth::user()->id,
            ]);
            return redirect()->back()->with(['warning' => "Super Admin Deleted Successfully"]);
        }

        return redirect()->back()->with(['warning' => "Operation delete Super Admin Not Successful"]);
    }

    public function JobTeamInviteeDelete(Request $request){
        $data = [
            "invitee_id" => "required"
        ];

        $data = $request->validate($data);
        $invitee = JobTeamInvite::find($data["invitee_id"]);
        if($invitee && $invitee->is_cancelled){
            $data = $invitee;
            $invitee->delete();
            logAction([
                'log_name' => 'Job Team Invitee Delete',
                'description' => 'An action that deletes a job team invitee',
                'action_type' => 'Delete',
                'causee_id' => $data->id,
                'causer_id' =>  Auth::user()->id,
            ]);
            return redirect()->back()->with(['success' => "Job Team Invitee Deleted Successfully"]);
        }
        return redirect()->back()->with(['error' => "Operation delete Job Team Invitee Not Successful"]);
    }
    
    public function fetchSchools(){
        $schools = School::get()->toArray();
        

        return $schools;
        
    }
}

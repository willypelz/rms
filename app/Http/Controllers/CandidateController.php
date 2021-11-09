<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Libraries\Solr;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\FolderContent;
use App\Models\Job;
use App\Models\JobActivity;
use App\Models\JobApplication;
use App\Models\Message as CandidateMessage;
use App\Models\Message;
use App\User;
use Auth;
use Carbon\Carbon;
use Curl;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Validator;


class CandidateController extends Controller
{


    public function login(Request $request)
    {
        if (Auth::guard('candidate')->check()) {
            return redirect()->route('candidate-dashboard');
        }
        $redirect_to = $request->redirect_to;
        
        $last_login = Carbon::now()->toDateTimeString();
        $applicant = Auth::guard('candidate')->first_name.' '.Auth::guard('candidate')->last_name;



        if ($request->isMethod('post')) {
            if (Auth::guard('candidate')->attempt(['email' => $request->email, 'password' => $request->password])) {
                if ($request->redirect_to) {
                    return redirect($request->redirect_to);
                } else {
                    return redirect()->route('candidate-dashboard');
                }

            } else {
                $request->session()->flash('warning', "Invalid Credentials");
                return back();
            }

        }
        return view('candidate.login', compact('redirect_to'));
    }

    public function logout(Request $request)
    {
        Auth::guard('candidate')->logout();
        return redirect()->route('candidate-login');
    }

    public function register(Request $request)
    {
        $redirect_to = $request->redirect_to;

        if ($request->isMethod('post')) {

            $candidate = Candidate::firstOrCreate([
                'email' => $request->email,
            ])->update($request->only(['first_name', 'last_name']) + [
                    'password' => bcrypt($request->input('password'))
                ]);

            if ($candidate) {

                if (Auth::guard('candidate')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    if ($request->redirect_to) {
                        return redirect($request->redirect_to);
                    } else {
                        return redirect()->route('candidate-dashboard');
                    }

                } else {
                    $request->session()->flash('error', "Could not register. Please try again.");
                    return back();
                }
            }

        }

        return view('candidate.register', compact('redirect_to'));
    }

    public function forgot(Request $request)
    {

        if($request->isMethod('post')){

            $candidate = Candidate::whereEmail($request->email)->first();

            if($candidate){

                $token = str_random(60).time();

                DB::table('password_resets')->insertGetId(
                    ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now() ]
                );


                Mail::send('emails.candidate-forgot-password', ['token' => $token], function ($m) use ($candidate) {
                    $m->from(env('COMPANY_EMAIL'), env('APP_NAME'));
                    $m->to($candidate->email, $candidate->first_name)->subject('Your Password Reset Link!');
                });


                return redirect()->route('candidate-forgot-sent');

            }else{
                return redirect()->back()->with('error', 'Failed to send reset link');
            }

        }

        $redirect_to = $request->redirect_to;

        return view('candidate.forgot', compact('redirect_to'));
    }


    public function forgotSent(Request $request)
    {

        return view('candidate.forgot-sent');
    }

    public function reset(Request $request, $token)
    {
        $redirect_to = $request->redirect_to;

        $token_reset = DB::table('password_resets')->where('token', $token)->first();


        if(is_null($token_reset))
            return redirect()->route('candidate-login')->with('error', 'Invalid password reset link');

        if($request->isMethod('post')){
            $this->validate($request, [
                'password' => 'required',
                'password_confirmation' => 'same:password',
            ]);




            $candidate = Candidate::whereEmail($token_reset->email)->first();
            $candidate->update(['password' => bcrypt($request->password)]);

            $name = $candidate->first_name.' '.$candidate->last_name;
            $last_login = Carbon::now()->toDateTimeString();

            $log_action = [
                'log_name' => "password reset",
                'description' => $name . " reset their password " . $last_login,
                'action_id' => $candidate->id,
                'action_type' => 'App\Models\Candidate',
                'causee_id' => $candidate->id,
                'causer_id' => $candidate->id,
                'causer_type' => 'applicant',
                'properties'=> ''
            ];
            logAction($log_action);

            DB::table('password_resets')->where('token', $token)->delete();

            return redirect()->route('candidate-login')->with('success', 'Password has been successfully update. You can login now.');
        }

        return view('candidate.reset', compact('redirect_to'));
    }


    public function dashboard(Request $request)
    {
        if (!Auth::guard('candidate')->check()) {
            return redirect()->route('candidate-login', ['redirect_to' => url()->current()]);
        }


        $applicant_id = $this->generateApplicationId(Auth::guard('candidate')->user());

        return view('candidate.dashboard', compact('applicant_id'));
    }

    public function activities(Request $request)
    {
        if (!Auth::guard('candidate')->check()) {
            return redirect()->route('candidate-login', ['redirect_to' => url()->current()]);
        }

        $application_id      = $request->application_id;
        $current_application = JobApplication::with('cv', 'job.company')->where('id', $application_id)->first();
        $ignore_list         = [
            'JOB-CREATED',
            'TEST_RESULT'
        ];
        $show_messages_tab   = true;
        $activities          = JobActivity::where('job_application_id', $application_id)->orderBy('id','DESC')->get();

        return view('candidate.activities',
            compact('application_id', 'ignore_list', 'show_messages_tab', 'activities', 'current_application'));
    }

    public function jobs(Request $request)
    {
        if (!Auth::guard('candidate')->check()) {
            return redirect()->route('candidate-login', ['redirect_to' => url()->current()]);
        }

        //Get All jobs applied to
        $job_ids = Auth::guard('candidate')->user()->applications->unique('job_id')->pluck('job_id')->toArray();

        $company_ids = Job::whereIn('id', $job_ids)->get()->unique('company_id')->pluck('company_id')->toArray();

        $candidate = Auth::guard('candidate')->user();

        if($candidate->is_from == 'external')
        {
            $jobs = Job::with('company')->whereDate('expiry_date', '>', date('Y-m-d'))->where('status','ACTIVE')->where('is_private', false)
            ->where(function($q){
                $q->where('is_for','external')->orWhere('is_for', 'both');
            })->get();
        }else{
            $jobs = Job::with('company')->whereDate('expiry_date', '>', date('Y-m-d'))->where('status','ACTIVE')->get();
        }
	    $companies =   Company::where('client_id',$request->clientId)->get();
        return view('candidate.job-list', compact('jobs', 'companies'));
    }

    public function jobList($company_id){
	    $candidate = Auth::guard('candidate')->user();

	    $company_details  = Company::find($company_id);
	    if($candidate->is_from == 'external')
	    {
		    $jobs = Job::whereCompanyId($company_id)->with('company')->whereDate('expiry_date', '>', date('Y-m-d'))->where('status','ACTIVE')->where('is_private', false)
			    ->where(function($q){
				    $q->where('is_for','external')->orWhere('is_for', 'both');
			    })->get();
	    }else{
		    $jobs = Job::whereCompanyId($company_id)->with('company')->whereDate('expiry_date', '>', date('Y-m-d'))->where('status','ACTIVE')->get();
	    }

	    $companies =   Company::where('client_id', request()->clientId)->get();
	    return view('candidate.job-list', compact('jobs', 'companies','company_details'));
    }

     /**
     * Bulk message modal to show applicants number and show to accept ot decline
     *
     * @return void
     */
     public function sendBulkMessageModal(Request $request)
    {

        $app_ids = explode(',', @$request->app_id);
        $params = urlencode($request->app_id);
        $count_applicants = count($app_ids);

        return view('candidate.messaging.action', compact(
            'count_applicants', 'params',
            'app_ids'
        ));
    }


     /**
     * Send Bulk message to candidate
     *
     * @return void
     */
    public function sendBulkMessage(Request $request, $ids)
    {
        $params = urldecode($ids);
        $app_ids = explode(',', $params);
        $nav_type = 'messages';

        $job_applications = JobApplication::with('cv')->find($app_ids);

        if($request->isMethod('post')){

            if ($request->hasFile('attachment')) {
                $file_name  = $request->attachment->getClientOriginalName();
                $attachment = $job_applications[0]->id . '-' . time() . '-' . $file_name;

                $request->file('attachment')->move(env('fileupload'), $attachment);

            } else {
                $attachment = '';
            }


            // Loop throgh applicants selected and dispatch message to them
            foreach ($job_applications as $key => $jb) {

                $user = Candidate::find($jb->candidate_id);
                $job = Job::find($jb->job_id);
                Message::create([
                    'job_application_id' => $jb->id,
                    'message' => $request->message,
                    'user_id' => Auth::id(),
                    'attachment' => $attachment,
                ]);

                $link = route('candidate-messages', $jb->id);

                $candidate = $user;
                $email_title = 'Feedback on your application';
                $company = get_current_company();
                $message_content = "You have received an update from {$company->name} on your job application: {$job->title}.";


                 Mail::send('emails.new.send_message', compact('candidate', 'email_title', 'message_content', 'user', 'link', 'job'), function ($m) use ($user, $email_title) {
                    $m->from(env('COMPANY_EMAIL'))->to($user->email)->subject($email_title);
                });

            }

            return redirect()->back()->with('success', 'Message has been sent successfully to applicant(s)');
        }

        return view('candidate.messaging.bulk', compact('nav_type', 'job_applications'));

    }


    public function messages(Request $request)
    {
        if (!Auth::guard('candidate')->check()) {
            return redirect()->route('candidate-login', ['redirect_to' => url()->current()]);
        }

        $application_id      = $request->application_id;
        $current_application = JobApplication::with('cv', 'job.company')->where('id', $application_id)->first();
        $messages            = Message::where('job_application_id', $request->application_id)->get();
        
        return view('candidate.messages', compact('messages', 'application_id', 'current_application'));
    }

    public function documents(Request $request)
    {
        if (!Auth::guard('candidate')->check()) {
            return redirect()->route('candidate-login', ['redirect_to' => url()->current()]);
        }

        $application_id      = $request->application_id;
        $current_application = JobApplication::with('cv', 'job.company')->where('id', $application_id)->first();


        $documents = Message::where('job_application_id', $application_id)
            ->where('attachment', '!=', '')
            ->where('user_id', null)
            ->get();

        return view('candidate.documents', compact('documents', 'application_id', 'current_application'));
    }

    public function sendMessage(Request $request)
    {
        if ($request->hasFile('document_file')) {
            if ($request->file('document_file')->getSize()  < 1) {
                return back()->withErrors(['warning' => 'Invalid file. Please check and try again.']);
            }
            $file_name  = (@$request->document_file->getClientOriginalName());
            $fi         = @$request->file('document_file')->getClientOriginalExtension();
            $document_file = $request->application_id . '-' . time() . '-' . $file_name;

            $upload = $request->file('document_file')->move(
                env('fileupload'), $document_file
            );
        } else {
            $document_file = '';
        }


        Message::create([
            'job_application_id' => $request->application_id,
            'message' => $request->message,
            'attachment' => $document_file,
            'title' => $request->document_title,
            'description' => $request->document_description
        ]);

        $job_application = JobApplication::find($request->application_id);
        $job = Job::find($job_application->job_id);
        // Get admin
        $admin_user = Message::where('job_application_id', $request->application_id)->whereNotNull('user_id')->first();

        if($admin_user){
            $user = User::find($admin_user->user_id);
        }else{
            $user = new \stdClass();
            $user->email = env('COMPANY_EMAIL');
            $user->name = "Admin";
            $user->first_name = "Admin";
        }

        $application_id = $request->application_id;

        $link = route('applicant-messages', $request->application_id);
        $candidate = Candidate::find($job_application->candidate_id);
        $email_title = $candidate->first_name." sent you a message.";
        $message_content = 'You just received a message from candidate: '.$candidate->first_name;


         Mail::send('emails.new.send_message', compact('candidate', 'email_title', 'message_content', 'user', 'link', 'job'), function ($m) use ($user, $email_title) {
            $m->from(env('COMPANY_EMAIL'))->to($user->email)->subject($email_title);
        });
        if ($candidate->is_from == 'internal') 
        {
            return response()->json(['status' => true, 'message' => 'sent']);
        }

        return redirect()->route('candidate-messages', ['application_id' => $application_id]);

    }

    private function generateApplicationId($candidate)
    {
        $id     = "";
        $string = explode("@", $candidate->email)[0];

        for ($i = 0; $i < strlen($string); $i++) {
            $id .= ord($string[$i]);

            if($i == 3)
                break;
        }


        $id .= $candidate->id;
        return $id;
    }

    public function candidateAccept(Request $request, $id, $token)
    {
        $candidate = Candidate::where(['id'=>$id, 'token'=>$token])->first();
        if ($candidate) {
            
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), ['password' => 'required|confirmed|min:6']);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
                Candidate::where('id', $request->id)->update(['password' => bcrypt($request->password), 'token' => '']);
                return redirect()->route('candidate-login')->with('success', 'Password Successfully Changed Please Login.');
            }
            return view('job.candidate-invite', compact('candidate'));
        } else {
            return redirect()->route('candidate-login')->with('error', 'Account Not Found');
        }
    }

    /**
     * @param Request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\view\view
     */

    public function profile(Request $request){

        $candidate = Candidate::find(Auth::guard('candidate')->id());
        if ($candidate) {
            if ($request->isMethod('post')) {

                $candidate->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                ]);

                return redirect()->route('candidate-profile')->with('success', 'Profile updated successfully');
            }
        } else {
            return redirect()->route('candidate-login')->with('error', 'Account Not Found');
        }

        return view('candidate.profile', compact('candidate'));
    }
}

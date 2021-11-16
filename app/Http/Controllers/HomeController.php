<?php

namespace App\Http\Controllers;

use Curl;
use Mail;
use App\Models\Job;
use App\Http\Requests;
use App\Libraries\Solr;
use App\Models\Company;
use App\Models\Candidate;
use App\Models\JobActivity;
use Illuminate\Http\Request;
use App\Models\FolderContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; 




class HomeController extends Controller
{
    private $search_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'application_date+desc', 'grouped'=>FALSE ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth', ['except' => [
          'requestACall',
          'pricing',
          'homepage',
          'home',
          'register',
          'viewTalentSource',
      ]]);
      
    }


     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function homepage()
    {

        $hirs_redirect = getEnvData('HIRS_REDIRECT_LOGIN');

        // if(!is_null($hirs_redirect) &&  strlen($hirs_redirect) != 0 )
        //     return redirect('login');

        return view('guest.landing');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function home(Request $request)
    {
        if (Auth::guard('candidate')->check()) {
            return redirect()->route('candidate-dashboard');
        }

        if (Auth::check()) {
            return redirect('dashboard');
        }

        $jobs = Job::whereStatus('ACTIVE')
	        ->where('is_for', '!=', 'internal')
            ->whereNotIn('is_private', [true])
            ->where('expiry_date', '>=', date('Y-m-d'))
            ->take(getEnvData('JOB_HOMEPAGE_LIST', 3))
            ->orderBy('id', 'desc')
            ->get();
        
        $redirect_to = $request->redirect_to;
        session()->put('redirect_to',$redirect_to);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $loginCred = ['email' => $request->input('email'), 'password' => $request->input('password'),'client_id'=> $request->clientId];
            //added client_id to login_cred array for candidates to only login to the intended dashboard, since there can now be multiple 
            //usage of same email provided it is for a different client
            if (Auth::guard('candidate')->attempt($loginCred)){
                
            
                if ($request->redirect_to) {
                    return redirect($request->redirect_to);
                } else {

                    //audit trail
                    audit_log();
                    return redirect()->route('candidate-dashboard');
                }

            } else {
                $request->session()->flash('warning', "Invalid Credentials");
                return back();
            }

        }


        return view('guest.landing', compact('jobs'));
    }


      public function register(Request $request)
    {
        $redirect_value = session()->get('redirect_to');
        $redirect_to = $request->redirect_to ?? $redirect_value;

        $jobs = Job::whereStatus('ACTIVE')->where('is_for', '!=', 'internal')->where('expiry_date', '>=', date('Y-m-d'))->take(getEnvData('JOB_HOMEPAGE_LIST', 3, request()->clientId))->orderBy('id', 'desc')->get();
        

        if ($request->isMethod('post')) {        

            $registerCandidate = "Initiate Candidate Register(Candidate)";
            mixPanelRecord($registerCandidate, $request);

            $this->validate($request, [
                'first_name' => 'required|regex:/^[a-zA-Z]+$/u',
                'last_name' => 'required|regex:/^[a-zA-Z]+$/u',
                'email' => ['required','email', Rule::unique('candidates')->where(function($query) use($request) {
                            $query->where('client_id', $request->clientId);
                            })],
                'password' => 'required',
            ]);


            $candidate = Candidate::firstOrCreate([
                'email' => $request->email,
                'client_id' => $request->clientId,
            ])->update($request->only(['first_name', 'last_name']) + [
                    'password' => bcrypt($request->input('password'))
                ]);
                
            $registerSuccess = "Candidate Registered Successfully(Candidate)";
            mixPanelRecord($registerSuccess, $request);

            if ($candidate) {

                if (Auth::guard('candidate')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $redirect_to = $request->redirect_to ?? session()->get('redirect_to');
                    if ($redirect_to) {
                        session()->forget('redirect_to');
                        return redirect($redirect_to);
                    } else {
                        //audit_trail
                        audit_log();
                        return redirect()->route('candidate-dashboard');
                    }

                } else {
                    $request->session()->flash('error', "Could not register. Please try again.");
                    return back();
                }
            }

        }

        return view('guest.register', compact('redirect_to', 'jobs'));
    }



    public function dashbaord()
    {
        $user = Auth::user();
        $comp_id = get_current_company()->id;


        $job_access = Job::with('users')->where('company_id',  $comp_id)->where('status','!=','DELETED');

        $jobs_count = $job_access->count();

        if(!$user->is_super_admin){

            $jobs_count = $job_access->whereHas('users', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    })->count();

        }


        $response = null;

        $posts =   @json_decode($response)->data->posts;
        $talent_pool_count = $saved_cvs_count = $purchased_cvs_count = '--';

        return view('talent-pool.dashboard', compact('posts', 'jobs_count','talent_pool_count','saved_cvs_count','purchased_cvs_count'));
    }

    public function viewTalentSource(Request $request)
    {
        if( $request->isMethod('post') )
        {
            $mail = Mail::send('emails.guest.talent-sourcing', $request->all(), function($message){
                $message->from('support@seamlesshiring.com');
                $message->to('support@seamlesshiring.com', 'Seamless Hiring Talent Sourcing Request');
            });

            if( $mail )
            {
                return response()->json( json_encode( [ 'status' => true ] ) );
            }
            else
            {
                return response()->json( json_encode( [ 'status' => false ] ) );
            }
        }

        return view('guest.talentSource');
    }

    public function requestACall(Request $request)
    {
        // Mail::send('emails.welcome', $data, function($message)
        // {
        //     // $message->from('us@example.com', 'Laravel');

        //     $message->to('foo@example.com')->cc('bar@example.com');

        //     $message->attach($pathToFile);
        // });

        Mail::send('emails.guest.request-call', $request->all(), function($message){
            $message->from('support@seamlesshiring.com');
            $message->to('support@seamlesshiring.com', 'Seamless Hiring Call Request');
        });
    }

    public function pricing( Request $request )
    {
        return view('guest.pricing');
    }

    


}

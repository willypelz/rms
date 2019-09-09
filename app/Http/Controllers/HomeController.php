<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Libraries\Solr;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\FolderContent;
use App\Models\Job;
use App\Models\JobActivity;
use Auth;
use Curl;
use Illuminate\Http\Request;
use Mail;


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

        $hirs_redirect = env('HIRS_REDIRECT_LOGIN');

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

        $jobs = Job::whereStatus('ACTIVE')->where('is_for', '!=', 'internal')->where('expiry_date', '>=', date('Y-m-d'))->take(env('JOB_HOMEPAGE_LIST', 3))->orderBy('id', 'desc')->get();

        $redirect_to = $request->redirect_to;

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


        return view('guest.landing', compact('jobs'));
    }


      public function register(Request $request)
    {

        $redirect_to = $request->redirect_to;
        $jobs = Job::whereStatus('ACTIVE')->where('is_for', '!=', 'internal')->where('expiry_date', '>=', date('Y-m-d'))->take(env('JOB_HOMEPAGE_LIST', 3))->orderBy('id', 'desc')->get();
        

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);


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

        return view('guest.register', compact('redirect_to', 'jobs'));
    }



    public function dashbaord()
    {
        $user = Auth::user();
        $comp_id = get_current_company()->id;
        $job_access = Job::where('company_id', $comp_id)
                        ->whereHas('users', function ($q) use ($user){
                            $q->where('user_id', $user->id);
                        })->get()->pluck('id')->toArray();

        

        
        $jobs_count = Job::where('company_id', $comp_id);

        if($user->is_super_admin){
        } else {
            $jobs_count = $jobs_count->whereIn('id', $job_access);
        }
        $jobs_count = $jobs_count->where('status','!=','DELETED')->count();

        $response = Curl::to('https://api.insidify.com/articles/get-posts')
                                ->withData(array('limit'=>6))
                                ->post();

        $posts = @json_decode($response)->data->posts;

        $talent_pool_count = $saved_cvs_count = $purchased_cvs_count = '--';

        // $talent_pool_count = Solr::get_all_my_cvs($this->search_params)['response']['numFound'];
        // $saved_cvs_count = Solr::get_saved_cvs($this->search_params)['response']['numFound'];
        // $purchased_cvs_count = Solr::get_purchased_cvs($this->search_params)['response']['numFound'];

        // Mail::queue('emails.cv-sales.invoice', [], function($message){
        //     $message->from(env('COMPANY_EMAIL'));
        //     $message->to('babatopeoni@gmail.com', 'SH test email');
        // });

        return view('talent-pool.dashboard', compact('posts', 'jobs_count','talent_pool_count','saved_cvs_count','purchased_cvs_count'));
    }

    public function viewTalentSource(Request $request)
    {
        if( $request->isMethod('post') )
        {
            $mail = Mail::queue('emails.guest.talent-sourcing', $request->all(), function($message){
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
        // Mail::queue('emails.welcome', $data, function($message)
        // {
        //     // $message->from('us@example.com', 'Laravel');

        //     $message->to('foo@example.com')->cc('bar@example.com');

        //     $message->attach($pathToFile);
        // });

        Mail::queue('emails.guest.request-call', $request->all(), function($message){
            $message->from('support@seamlesshiring.com');
            $message->to('support@seamlesshiring.com', 'Seamless Hiring Call Request');
        });
    }

    public function pricing( Request $request )
    {
        return view('guest.pricing');
    }


}

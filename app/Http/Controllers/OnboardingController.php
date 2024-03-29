<?php

namespace App\Http\Controllers;

use Auth;
use Curl;
use Mail;
use App\User;
use Carbon\Carbon;
use App\Models\Job;
use App\Http\Requests;
use App\Libraries\Solr;
use App\Models\Company;
use App\Models\JobActivity;
use Illuminate\Http\Request;
use App\Models\FolderContent;
use App\SearchEngine\SearchEngine;
use SeamlessHR\SolrPackage\Facades\SolrPackage;


class OnboardingController extends Controller
{
    private $search_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'application_date+desc', 'grouped'=>FALSE ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->searchEngine = app(SearchEngine::class);
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

    public function dashbaord()
    {

        $comp_id = get_current_company()->id;
        $jobs_list =  Job::where('company_id', $comp_id)->where('status','!=','DELETED');
        $jobs_count = $jobs_list->count();

        // dd($jobs);
        $response = Curl::to('https://api.insidify.com/articles/get-posts')
                                ->withData(array('limit'=>6))
                                ->post();

        $posts = @json_decode($response)->data->posts;

        $talent_pool_count = $this->searchEngine->get_all_my_cvs($this->search_params)['response']['numFound'];
        $saved_cvs_count = $this->searchEngine->get_saved_cvs($this->search_params)['response']['numFound'];
        $purchased_cvs_count = $this->searchEngine->get_purchased_cvs($this->search_params)['response']['numFound'];

        // dd( FolderContent::where('getFolderType.type','saved')->get()->toArray() );
        $activities_exist = showActivitiesButton($jobs_list);
        
        return view('talent-pool.dashboard', compact('posts', 'jobs_count','talent_pool_count','saved_cvs_count','purchased_cvs_count','activities_exist'));
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
            $message->from(getEnvData('COMPANY_EMAIL'));
            $message->to('support@seamlesshiring.com', 'Seamless Hiring Call Request');
        });
    }



    public function noAction1( Request $request )
    {
        Company::with('users')->where('license_type','TRIAL')->whereDate('valid_till', '<=' ,Carbon::now()->subDays(2)->toDateTimeString() )->chunk(50,function($companies){
            foreach ($companies as $key => $company) {

                if( $company->last_mail_sent == "")
                {
                    $owner = $company->users->first();

                    $company->last_mail_sent = 'noAction1';
                    $company->save();

                    // $mail = Mail::send('emails.new.onboarding.signedup_because', ['email' => $owner->email, 'name' => $owner->name], function($message) use($owner){
                    //     $message->from('support@seamlesshiring.com')
                    //              ->to($owner->email)
                    //              ->subject('You signed up because…');
                    // });
                }
                
            }
        });

    }

    public function noAction2( Request $request )
    {

        Company::with('users')->where('license_type','TRIAL')->whereDate('valid_till', '<=' ,Carbon::now()->subDays(5)->toDateTimeString() )->chunk(50,function($companies){
            foreach ($companies as $key => $company) {

                if( $company->last_mail_sent == "noAction1")
                {
                    $owner = $company->users->first();

                    $company->last_mail_sent = 'noAction2';
                    $company->save();


                    // $mail = Mail::send('emails.new.onboarding.why_wait', ['email' => $owner->email, 'name' => $owner->name], function($message) use($owner){
                    //     $message->from('support@seamlesshiring.com')
                    //              ->to($owner->email)
                    //              ->subject('Why wait? Let’s get you started.');
                    // });
                }
                
            }
        });

    }

    public function noAction3( Request $request )
    {
        $owner = (object) [ 'email' => 'babatopeoni@gmail.com', 'name' => 'Babatope Oni' ];
        $mail = Mail::send('emails.new.onboarding.better_hiring_process', ['email' => $owner->email, 'name' => $owner->name], function($message) use($owner){
                        $message->from('support@seamlesshiring.com')
                                 ->to($owner->email)
                                 ->subject('Let Us Help You Build a Better Hiring Process.');
                    });

        Company::with('users')->where('license_type','TRIAL')->whereDate('valid_till', '<=' ,Carbon::now()->subDays(7)->toDateTimeString() )->chunk(50,function($companies){
            foreach ($companies as $key => $company) {

                if( $company->last_mail_sent == "noAction2")
                {
                    $owner = $company->users->first();

                    $company->last_mail_sent = 'noAction3';
                    $company->save();


                    // $mail = Mail::send('emails.new.onboarding.better_hiring_process', ['email' => $owner->email, 'name' => $owner->name], function($message) use($owner){
                    //     $message->from('support@seamlesshiring.com')
                    //              ->to($owner->email)
                    //              ->subject('Let Us Help You Build a Better Hiring Process.');
                    // });
                }
                
            }
        });

    }


    public function actionTaken1( Request $request )
    {
        $owner = (object) [ 'email' => 'babatopeoni@gmail.com', 'name' => 'Babatope Oni' ];
        $mail = Mail::send('emails.new.onboarding.better_hiring_process', ['email' => $owner->email, 'name' => $owner->name], function($message) use($owner){
                        $message->from('support@seamlesshiring.com')
                                 ->to($owner->email)
                                 ->subject('Let Us Help You Build a Better Hiring Process.');
                    });

        /*Company::with('users')->where('license_type','TRIAL')->whereDate('valid_till', '<=' ,Carbon::now()->subDays(7)->toDateTimeString() )->chunk(50,function($companies){
            foreach ($companies as $key => $company) {

                if( $company->last_mail_sent == "noAction2")
                {
                    $owner = $company->users->first();

                    $company->last_mail_sent = 'noAction3';
                    $company->save();


                    // $mail = Mail::send('emails.new.onboarding.better_hiring_process', ['email' => $owner->email, 'name' => $owner->name], function($message) use($owner){
                    //     $message->from('support@seamlesshiring.com')
                    //              ->to($owner->email)
                    //              ->subject('Let Us Help You Build a Better Hiring Process.');
                    // });
                }
                
            }
        });*/

    }

    
}

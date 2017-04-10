<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Curl;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobActivity;
use App\Libraries\Solr;
use Auth;
use App\Models\FolderContent;
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
        // $this->middleware('auth');
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
        $jobs_count = Job::where('company_id', $comp_id)->where('status','!=','DELETED')->count();

        // dd($jobs);
        $response = Curl::to('https://api.insidify.com/articles/get-posts')
                                ->withData(array('limit'=>6))
                                ->post();

        $posts = @json_decode($response)->data->posts;

        $talent_pool_count = Solr::get_all_my_cvs($this->search_params)['response']['numFound'];
        $saved_cvs_count = Solr::get_saved_cvs($this->search_params)['response']['numFound'];
        $purchased_cvs_count = Solr::get_purchased_cvs($this->search_params)['response']['numFound'];

        // dd( FolderContent::where('getFolderType.type','saved')->get()->toArray() );
         
        // Mail::send('emails.cv-sales.invoice', [], function($message){
        //     $message->from('no-reply@insidify.com');
        //     $message->to('babatopeoni@gmail.com', 'SH test email');
        // }); 

        return view('talent-pool.dashboard', compact('posts', 'jobs_count','talent_pool_count','saved_cvs_count','purchased_cvs_count'));
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
            $message->from('no-reply@insidify.com');
            $message->to('deji@insidify.com', 'Seamless Hiring Call Request');
        });
    }

    public function pricing( Request $request )
    {
        return view('guest.pricing');
    }

    
}

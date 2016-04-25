<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\JobApplication;
use App\Models\Job;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\AtsRequest;
use App\Libraries\Solr;
use App\Models\AtsService;
use App\Models\AtsProduct;
use App\Models\TestRequest;
use App\Models\Interview;
use Carbon\Carbon;
use Auth;


class JobApplicationsController extends Controller
{
    private $search_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'application_date+desc', 'grouped'=>FALSE ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function assess($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'assess';

        $requests = TestRequest::where('job_application_id',$appl_id)->with('product.provider')->get();
        
        return view('applicant.assess', compact('appl', 'nav_type','requests'));
    }

    public function activities($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);
        // dd($appl);
        $nav_type = 'activities';
        return view('applicant.activities', compact('appl', 'nav_type'));
    }

    public function medicals($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'medicals';

        $requests = $appl->requests()->with('product.provider')->where('service_type', 'HEALTH')->get();

        
        return view('applicant.medicals', compact('appl', 'nav_type', 'requests'));
    }

    public function notes($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'notes';
        
        return view('applicant.notes', compact('appl', 'nav_type'));
    }

    public function checks($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'checks';

        $requests = $appl->requests()->with('product.provider')->where('service_type', 'BACKGROUND')->get();


        return view('applicant.checks', compact('appl', 'nav_type', 'requests'));
    }

    public function Profile($appl_id){

    	$appl = JobApplication::with('job', 'cv')->find($appl_id);

    	$nav_type = 'profile';

    	// dd($appl->toArray());

    	return view('applicant.profile', compact('appl', 'nav_type'));

    }


    public function Messages($appl_id){

    	$appl = JobApplication::with('job', 'cv')->find($appl_id);

    	$nav_type = 'messages';

    	// dd($appl->toArray());

    	return view('applicant.messages', compact('appl', 'nav_type'));

    }

    public function viewApplicants( Request $request )
    {
        $job = Job::find($request->jobID);
        $active_tab = 'candidates';
        $jobID = $request->jobID;

        $this->search_params['filter_query'] = @$request->filter_query;
        $this->search_params['start'] = $start = ( $request->start ) ? ( $request->start * $this->search_params['row'] ) : 0;
        
        
        $result = Solr::get_applicants($this->search_params, $request->jobID,@$request->status);

        $end = (($start + $this->search_params['row']) > intval($result['response']['numFound']))?$result['response']['numFound']:($start + $this->search_params['row']);
        $showing = "Showing ".($start+1)." - ".$end." of ".$result['response']['numFound']." Applicants [Page ".floor($request->start + 1)."]";

        $filter_text = '';
        if(isset($request->filter_query)){

            $filter_text .= "<br/>Filtering by: ";
            foreach ($request->filter_query as $fq) {
                
                $filter_text .= ucwords(str_ireplace("_", " ", $fq)).', ';
            }

            $filter_text .= ".";

        }
        $showing .= $filter_text . '<a id="clearAllFilters" href="javacript://" >Clear Filter</a>';

        if($request->ajax())
        {
            $search_results = view('job.board.includes.applicant-results-item', compact('job', 'active_tab','result','jobID','start'))->render();    
            $search_filters = view('cv-sales.includes.search-filters',['result' => $result,'search_query' => $request->search_query])->render();
            return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters, 'showing'=>$showing ] );
            
        }
        else{
            $application_statuses = get_application_statuses( $result['facet_counts']['facet_fields']['application_status'] );
            return view('job.board.candidates', compact('job', 'active_tab','result','application_statuses','jobID','start'));
        }

        
    }



    public function massAction( Request $request )
    {
        JobApplication::massAction( $request->job_id, $request->cv_ids, $request->status );
    }

    public function writeReview( Request $request )
    {
         return save_activities('REVIEW',  $request->job_id, $request->job_app_id, $request->comment );
    }

    public function JobListData(Request $request){

        $result = Solr::get_applicants($this->search_params, $request->job_id,@$request->status);
        $application_statuses = get_application_statuses( $result['facet_counts']['facet_fields']['application_status'] );

        if($request->type == 'job_view'){
            $total_applicants = ($result['response']['numFound']);
            echo $total_applicants;
            // exit;
        }
        
        $stats = '<div class="job-item ">
                    <span class="number">'.$application_statuses['HIRED'].'</span><br/>Hired
                </div>
                <div class="job-item ">
                    <span class="number">'.$application_statuses['ASSESSED'].'</span><br/>Assessed
                </div>
                <div class="job-item ">
                    <span class="number">'.$application_statuses['INTERVIEWED'].'</span><br/>Interviewed
                </div>
                <div class="job-item ">
                    <span class="number text-muted">'.$application_statuses['SHORTLISTED'].'</span><br/>Reviewed
                </div>
                <div class="job-item  purple">
                    <span class="number text-muted">'.$result['response']['numFound'].'</span><br/>All
                </div>';

        // dd($stats);
                echo $stats;
    }

    public function JobViewData(Request $request){


        $result = Solr::get_applicants($this->search_params, $request->job_id,@$request->status);
        $total_applicants = ($result['response']['numFound']);
        $matching = 10000;

        $job = Job::find($request->job_id);

        $now = time(); // or your date as well
         $your_date = strtotime($job->post_date);
         $datediff = $now - $your_date;
         $open_days =  floor($datediff/(60*60*24));

         $amount_spent = 0;
        
           $stats =      '<table class="table table-bordered"> 
                            <tbody> 
                        <tr> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="jos/list">'.$total_applicants.'</a></h1><small class="text-muted">Applicants</small></td> 
                            <!--td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">'.$matching.'</a></h1><small class="text-muted">Matching Candidates</small></td--> 
                        </tr> 
                        <tr> 
                            <td class="text-center"><h1 class="no-margin text-muted">'.$open_days.'</h1><small class="text-muted">Days Opended</small></td> 
                            <!--td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">'.$amount_spent.'</a></h1><small class="text-muted">Amount Spent</small></td--> 
                        </tr>
                        </tbody> 
                        </table>';
        echo $stats;

    }


    public function modalComment(Request $request)
    {
        // $appl = JobApplication::with('job', 'cv')->find( $request->app_id );
        // echo "<pre>";
        // var_dump($appl);
        // echo "</pre>";
        // $applicant_badge = $this->getApplicantBadge( $request->cv_id );
        
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);
        $jobID = $appl->job->id;

        return view('modals.comment', compact('applicant_badge','app_id','cv_id','jobID'));
    }

    public function modalInterview(Request $request)
    {
        // $appl = JobApplication::with('job', 'cv')->find( $request->app_id );
        // echo "<pre>";
        // var_dump($appl);
        // echo "</pre>";
        // $applicant_badge = $this->getApplicantBadge( $request->cv_id );
        
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);

        return view('modals.interview', compact('applicant_badge','app_id','cv_id','appl'));
    }

    
    public function modalShortlist(Request $request)
    {
        
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);

        return view('modals.shortlist', compact('applicant_badge','app_id','cv_id','appl'));
    }

    public function modalReject(Request $request)
    {
        
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);

        return view('modals.reject', compact('applicant_badge','app_id','cv_id','appl'));
    }

    

    public function modalAssess(Request $request)
    {
        // $appl = JobApplication::with('job', 'cv')->find( $request->app_id );
        // echo "<pre>";
        // var_dump($appl);
        // echo "</pre>";
        // $applicant_badge = $this->getApplicantBadge( $request->cv_id );
        // 
        
        
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);
        // $requests = $appl->requests()->with('product.provider')->where('service_type', 'background')->get();
        $test_available = true;
        // $services = AtsService::all()->toArray() ;

        $products = AtsProduct::all(); 
        $section = 'TEST';
        return view('modals.assess', compact('applicant_badge','app_id','cv_id','products','appl','test_available','section'));
    }

    public function modalBackgroundCheck(Request $request)
    {
        // $appl = JobApplication::with('job', 'cv')->find( $request->app_id );
        // echo "<pre>";
        // var_dump($appl);
        // echo "</pre>";
        // $applicant_badge = $this->getApplicantBadge( $request->cv_id );
        // 
        
        
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);
        // $requests = $appl->requests()->with('product.provider')->where('service_type', 'background')->get();
        // $test_available = true;
        // $services = AtsService::all()->toArray() ;

        $products = AtsProduct::all();
        $section = 'BACKGROUND'; 
        return view('modals.assess', compact('applicant_badge','app_id','cv_id','products','appl','test_available','section'));
    }


    public function modalMedicalCheck(Request $request)
    {
        // $appl = JobApplication::with('job', 'cv')->find( $request->app_id );
        // echo "<pre>";
        // var_dump($appl);
        // echo "</pre>";
        // $applicant_badge = $this->getApplicantBadge( $request->cv_id );
        // 
        
        
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);
        // $requests = $appl->requests()->with('product.provider')->where('service_type', 'background')->get();
        // $test_available = true;
        // $services = AtsService::all()->toArray() ;

        $products = AtsProduct::all();
        $section = 'HEALTH'; 
        return view('modals.assess', compact('applicant_badge','app_id','cv_id','products','appl','test_available','section'));
    }

    
    

    public function requestTest(Request $request)
    {
        
        $comp_id = Auth::user()->companies[0]->id;
        $invoice_no = '#'.mt_rand();


        $order = Order::firstOrCreate([
                        'company_id' => $comp_id,
                        'order_date'=> date('Y-m-d H:i:s'),
                        'total_amount'=>$request->total_amount,
                        'invoice_no'=> $invoice_no,
                        'type'=> $request->type
        ]);

         $transaction = Transaction::firstOrCreate([
            'order_id' => $order->id,
            'status'=> 'false',
            'message'=>'Transaction Not Found'
        ]);


        foreach ($request->tests as $key => $test) {
            
            $orderItems = OrderItem::firstOrCreate([
                        'order_id' => $order->id,
                        'itemId' => $test['id'],
                        'type' => $request->type,
                        'name' => $test['name'],
                        'price' => $test['cost']
             ]);

            $data = [
                'location' => @$request->location,
                'start_time' => @$request->start_time,
                'end_time' => @$request->end_time,
                'job_application_id' => @$request->job_application_id,
                'test_id' => $test['id'],
                'test_name' => $test['name'],
                'test_owner' => $test['owner'],
                'order_id' => $order->id,
            
            ];
                        
            TestRequest::create($data);
            // var_dump($data);
        }

        JobApplication::massAction( @$request->job_id, [ @$request->cv_id ], 'ASSESSED' );

        $res = array();
        $res = ['total_amount'=>$request->total_amount, 'order_id'=>$order->id];
        return $res;

    }

    public function requestCheck(Request $request)
    {
        $comp_id = Auth::user()->companies[0]->id;
        $invoice_no = '#'.mt_rand();

        $order = Order::firstOrCreate([
                        'company_id' => $comp_id,
                        'order_date'=> date('Y-m-d H:i:s'),
                        'total_amount'=>$request->total_amount,
                        'invoice_no'=> $invoice_no,
                        'type'=> $request->type
        ]);

        $transaction = Transaction::firstOrCreate([
            'order_id' => $order->id,
            'status'=> 'false',
            'message'=>'Transaction Not Found'
        ]);

        foreach ($request->checks as $key => $check) {
            
            $orderItems = OrderItem::firstOrCreate([
                        'order_id' => $order->id,
                        'itemId' => $check['id'],
                        'type' => $request->type,
                        'name' => $check['name'],
                        'price' => $check['cost']
             ]);

            $data = [
                'job_application_id' => @$request->job_application_id,
                'job_id' => @$request->job_id,
                'ats_product_id' => $check['id'],
                'cost' => $check['cost'],
                'service_type' => @$request->service_type,
                'created' => Carbon::now(),
                'modified' => Carbon::now(),
                'order_id' => $order->id
            
            ];
                        
            AtsRequest::create($data);
            // var_dump($data);

        }
            $res = array();
            $res = ['total_amount'=>$request->total_amount, 'order_id'=>$order->id];
            return $res;
        // JobApplication::massAction( @$request->job_id, [ @$request->cv_id ], 'ASSESSED' );
    }
    

    public function Checkout(Request $request){
        // dd($request->total_amount);
       


    }

    public function inviteForInterview(Request $request)
    {
            $data = [
                'location' => @$request->location,
                'message' => @$request->message,
                'date' => @$request->date
            ];
                        
            Interview::create($data);
            // var_dump($data);
        

        JobApplication::massAction( @$request->job_id, [ @$request->cv_id ], 'INTERVIEWED' );

    }
    

    
    public function getApplicantBadge($cv)
    {
        return view('modals.applicant_badge',compact('cv'))->render();
        
    }
}

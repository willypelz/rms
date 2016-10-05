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
use App\Models\InterviewNotes;
use Carbon\Carbon;
use Auth;
use Excel;
use App;



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
        return view('applicant.activities', compact('appl', 'nav_type','result','application_statuses'));
    }

    public function medicals($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'medicals';

        $requests = $appl->requests()->with('product.provider')->where('service_type', 'HEALTH')->get();

        
        return view('applicant.medicals', compact('appl', 'nav_type', 'requests'));
    }

    public function notes($appl_id){

        $appl = JobApplication::with('job', 'cv','interview_notes')->find($appl_id);

        $nav_type = 'notes';

        $interview_notes = $appl->interview_notes()->with('user')->get();
        
        return view('applicant.notes', compact('appl', 'nav_type', 'interview_notes'));
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
        //Check if he  is the owner of the job
        check_if_job_owner( $request->jobID ) ;
        
        $job = Job::find($request->jobID);
        $active_tab = 'candidates';
        $status = '';
        $jobID = $request->jobID;

        $this->search_params['filter_query'] = @$request->filter_query;
        $this->search_params['start'] = $start = ( $request->start ) ? ( $request->start * $this->search_params['row'] ) : 0;
        
        //If age is available
        if( @$request->age ){
            $date = Carbon::now();
            //2015-09-16T00:00:00Z
            $start_dob = str_replace('+', '', $date->subYears( @$request->age[0] )->toIso8601String() ). "Z" ; 
            $end_dob = str_replace('+', '', $date->subYears( @$request->age[1] )->toIso8601String() ). "Z"; 

            $solr_age = [ $start_dob, $end_dob ];
            // dd($request->age, $start_dob, $end_dob);
        }
        else
        {
            $request->age = [ 15, 65 ];
            $solr_age = null;
        }


        //If years of experience is available
        if( @$request->exp_years ){
            //2015-09-16T00:00:00Z

            $solr_exp_years = [ @$request->exp_years[0], @$request->exp_years[1] ];
        }
        else
        {
            $request->exp_years = [ 0, 40 ];
            $solr_exp_years = null;
        }
        
        $result = Solr::get_applicants($this->search_params, $request->jobID,@$request->status,@$solr_age, @$solr_exp_years); 
        if(isset($request->status))
            $status = $request->status;

        $end = (($start + $this->search_params['row']) > intval($result['response']['numFound']))?$result['response']['numFound']:($start + $this->search_params['row']);
        // $showing = "Showing ".($start+1)." - ".$end." of ".$result['response']['numFound']." Applicants [Page ".floor($request->start + 1)."]";


        $showing = view('cv-sales.includes.top-summary',['start' => ( $start + 1 ),'end' => $end, 'total'=> $result['response']['numFound'], 'type'=>$request->status, 'page' => floor($request->start + 1), 'filters' => $request->filter_query ])->render();    

        if($request->ajax())
        {
            $search_results = view('job.board.includes.applicant-results-item', compact('job', 'active_tab', 'status', 'result','jobID','start'))->render();    
            $search_filters = view('cv-sales.includes.search-filters',['result' => $result,'search_query' => $request->search_query, 'status' => $status, 'age' => @$request->age,'exp_years' => @$request->exp_years ])->render();
            return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters, 'showing'=>$showing ] );
            
        }
        else{
            $age = [ 15, 65 ];
            $exp_years = [ 0, 40 ];
            $application_statuses = get_application_statuses( $result['facet_counts']['facet_fields']['application_status'] );
            return view('job.board.candidates', compact('job', 'active_tab', 'status', 'result','application_statuses','jobID','start','age','exp_years','showing'));
        }

        
    }

    public function downloadApplicantSpreadsheet( Request $request ){
        
        //Check if you should have access to the excel
        check_if_job_owner( $request->jobId ) ;

        $job = Job::find($request->jobId);

        // dd( $job );

        $this->search_params['filter_query'] = @$request->filter_query;
        $this->search_params['row'] = 2147483647;


        //If age is available
        if( @$request->age ){
            $date = Carbon::now();
            //2015-09-16T00:00:00Z
            $start_dob = str_replace('+', '', $date->subYears( @$request->age[0] )->toIso8601String() ). "Z" ; 
            $end_dob = str_replace('+', '', $date->subYears( @$request->age[1] )->toIso8601String() ). "Z"; 

            $solr_age = [ $start_dob, $end_dob ];
            // dd($request->age, $start_dob, $end_dob);
        }
        else
        {
            $request->age = [ 15, 65 ];
            $solr_age = null;
        }


        //If years of experience is available
        if( @$request->exp_years ){
            //2015-09-16T00:00:00Z

            $solr_exp_years = [ @$request->exp_years[0], @$request->exp_years[1] ];
        }
        else
        {
            $request->exp_years = [ 0, 40 ];
            $solr_exp_years = null;
        }

        $result = Solr::get_applicants($this->search_params, $request->jobId,@$request->status,@$solr_age, @$solr_exp_years); 

        $data = $result['response']['docs'];
        $other_data = [

                    'company' => get_current_company()->name,
                    'user' => Auth::user()->name,
                    'job_title' => $job->title,
        ];

        $excel_data = [];

        foreach ($data as $key => $value) {
            $excel_data[] = [
                                "FIRSTNAME" => $value['first_name'],
                                "LASTNAME" => $value['last_name'],
                                "LAST POSITION HELD" => $value['last_position'],
                                "HEADLINE" => $value['headline'][0],
                                "GENDER" => $value['gender'],
                                "MARITAL STATUS" => $value['marital_status'],
                                "DATE OF BIRTH" => substr($value['dob'], 0 ,10),
                                "AGE" => '',
                                "LOCATION" => $value['state'],
                                "EMAIL" => $value['email'],
                                "PHONE" => $value['phone'],
                                "COVER NOTE" => $value['cover_note'][0],
                                "HIGHEST EDUCATION" => $value['highest_qualification'],
                                "LAST COMPANY WORKED AT" => $value['last_company_worked'],
                                "YEARS OF EXPERIENCE" => $value['years_of_experience'],
                                "WILLING TO RELOCATE?" => '',
                                // "JOB TITLE" => $job->title,
                                
                                // "cv_file" => "1470054202_cheidiatgmailcom_Moyosoluwa's draft.docx"
                                // "display_picture" => "default-profile.png"
                                // "rank" => 1
                                // "id" => "5617"
                                // "last_modified" => "2016-09-23T05:54:57Z"
                                // "application_date" => "2016-08-01T13:23:22Z"
                                // "application_modified" => "2016-08-01T13:23:22Z"
                                // "application_id" => array:1 [▶]
                                // "application_status" => array:1 [▶]
                                // "_version_" => 1.5462453107564E+18
                              ];
        }

        // dd($excel_data);

        $excel = App::make('excel'); 

        Excel::create('Applicants Report: '.$other_data['job_title'], function($excel) use($excel_data, $other_data) {
            // Set the title
            $excel->setTitle('Applicants Report: '.$other_data['job_title']);
            $excel->setCreator( $other_data['user'] )->setCompany( $other_data['company'] );
            // $excel->setDescription('report file');

            $excel->sheet('Report', function($sheet) use($excel_data, $other_data) {
           

                // first row styling and writing content
                // $sheet->mergeCells('A1:W1');
                // $sheet->row(1, function ($row) {
                //     $row->setFontFamily('Comic Sans MS');
                //     $row->setFontSize(30);
                // });

                // $sheet->row(1, array('Some big header here'));

                $sheet->fromArray($excel_data, null, 'A1', false, true);
                $sheet->cells('A1:P1', function($cells) {
                    $cells->setBackground('#eeeeee');



                });

                

                $sheet->setColumnFormat(['G' => 'dd/mm/yyyy']);

                $sheet->setStyle([
                    'alignment' => [
                        'vertical' => 'middle',
                        'horizontal' => 'left'
                    ]
                ]);
                // $sheet->setVerticalAlign('text-top');

                // $sheet->setFitToPage(true);
                // $sheet->setFitToHeight(true);
                // $sheet->setFitToWidth(true);
               
                // $sheet->setAutoSize(true);

                
            });
        })->download('xlsx');

    }

    public function massAction( Request $request )
    {

        JobApplication::massAction( $request->job_id, $request->cv_ids, $request->status );
        return save_activities($request->status,  $request->job_id, $request->app_ids );
    }

    public function writeReview( Request $request )
    {
         return save_activities('REVIEW',  $request->job_id, $request->app_ids, $request->comment );
    }

    public function getAllApplicantStatus(Request $request)
    {
         $result = Solr::get_applicants($this->search_params, $request->job_id,@$request->status);
        $application_statuses = get_application_statuses( $result['facet_counts']['facet_fields']['application_status'] );
        return view('job.board.includes.applicant-status', compact('application_statuses','result'));
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
                    <span class="number">'.$application_statuses['ASSESSED'].'</span><br/>Tested
                </div>
                <div class="job-item ">
                    <span class="number">'.$application_statuses['INTERVIEWED'].'</span><br/>Interviewed
                </div>
                <div class="job-item ">
                    <span class="number text-muted">'.$application_statuses['SHORTLISTED'].'</span><br/>Shortlisted
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
                            <td class="text-center"><h1 class="no-margin text-muted">'.$open_days.'</h1><small class="text-muted">Days Opened</small></td> 
                            <!--td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">'.$amount_spent.'</a></h1><small class="text-muted">Amount Spent</small></td--> 
                        </tr>
                        </tbody> 
                        </table>';
        echo $stats;

    }


    public function modalComment(Request $request)
    {
        $modalVars = $this->modalActions('Interview', $request->cv_id, $request->app_id);
        if( is_array( $modalVars ) )
        {
            extract($modalVars);
        }
        else
        {
            return $modalVars;
        }
        
        $jobID = $appl->job->id;

        return view('modals.comment', compact('applicant_badge','app_ids','cv_ids','jobID','appl'));
    }

    public function modalInterview(Request $request)
    {
        $modalVars = $this->modalActions('Interview', $request->cv_id, $request->app_id);
        if( is_array( $modalVars ) )
        {
            extract($modalVars);
        }
        else
        {
            return $modalVars;
        }

        return view('modals.interview', compact('applicant_badge','app_ids','cv_ids','appl'));
    }

    public function modalInterviewNotes(Request $request)
    {
        
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);

        $notes = InterviewNotes::where('job_application_id',$app_id)->where('interviewer_id', @Auth::user()->id)->get()->toArray(); 


        return view('modals.interview-notes', compact('applicant_badge','app_id','cv_id','appl','notes'));
    }

    
    
    public function modalShortlist(Request $request)
    {
        $modalVars = $this->modalActions('Shortlist', $request->cv_id, $request->app_id);
        if( is_array( $modalVars ) )
        {
            extract($modalVars);
        }
        else
        {
            return $modalVars;
        }
        
        

        return view('modals.shortlist', compact('applicant_badge','app_ids','cv_ids','appl'));
    }

    public function modalReturnToAll(Request $request)
    {
        
       $modalVars = $this->modalActions( 'Return', $request->cv_id, $request->app_id);
        if( is_array( $modalVars ) )
        {
            extract($modalVars);
        }
        else
        {
            return $modalVars;
        }
        

        return view('modals.return_to_all', compact('applicant_badge','app_ids','cv_ids','appl'));
    }

    public function modalAddToWaiting(Request $request)
    {
        
       $modalVars = $this->modalActions( 'Waiting List: Add', $request->cv_id, $request->app_id);
        if( is_array( $modalVars ) )
        {
            extract($modalVars);
        }
        else
        {
            return $modalVars;
        }
        

        return view('modals.add_to_waiting', compact('applicant_badge','app_ids','cv_ids','appl'));
    }

    


    public function modalReject(Request $request)
    {
        $modalVars = $this->modalActions('Reject', $request->cv_id, $request->app_id);
        if( is_array( $modalVars ) )
        {
            extract($modalVars);
        }
        else
        {
            return $modalVars;
        }
        
        

        return view('modals.reject', compact('applicant_badge','app_ids','cv_ids','appl'));
    }

    private function modalActions($action,$cv_ids,$app_ids)
    {
        $app_ids = explode(',', @$app_ids);
        $cv_ids = explode(',', @$cv_ids);
        $appl = JobApplication::with('job', 'cv')->find($app_ids[0]);

        if( count($cv_ids) > 1 && count($app_ids) > 1)
        {
            $applicant_badge = @$this->getMultipleApplicantBadge($action, count($cv_ids) );
        }
        else if( count($cv_ids) == 1 && count($app_ids) == 1)
        {
            
            $applicant_badge = @$this->getApplicantBadge($appl->cv);
        }
        else
        {
            return " There an error. Please contact the administrator";
        }

        return [
             'applicant_badge' =>  $applicant_badge,
             'app_ids' =>  $app_ids,
             'cv_ids' =>  $cv_ids,
             'appl' =>  $appl,
        ];
    }

    

    public function modalAssess(Request $request)
    {
        $modalVars = $this->modalActions('Test', $request->cv_id, $request->app_id);
        if( is_array( $modalVars ) )
        {
            extract($modalVars);
        }
        else
        {
            return $modalVars;
        }

        $test_available = true;
        $count = count($cv_ids);

        $products = AtsProduct::all(); 
        $section = 'TEST';
        return view('modals.assess', compact('applicant_badge','app_ids','cv_ids','products','appl','test_available','section','count'));
    }

    public function modalBackgroundCheck(Request $request)
    {
        
        
        $modalVars = $this->modalActions('Background Check for', $request->cv_id, $request->app_id);
        if( is_array( $modalVars ) )
        {
            extract($modalVars);
        }
        else
        {
            return $modalVars;
        }

        $products = AtsProduct::all();
        $count = count($cv_ids);

        $section = 'BACKGROUND'; 
        return view('modals.assess', compact('applicant_badge','app_ids','cv_ids','products','appl','test_available','count','section'));
    }


    public function modalMedicalCheck(Request $request)
    {
        
        $modalVars = $this->modalActions('Health Check for', $request->cv_id, $request->app_id);
        if( is_array( $modalVars ) )
        {
            extract($modalVars);
        }
        else
        {
            return $modalVars;
        }

        $products = AtsProduct::all();
        $count = count($cv_ids);

        $section = 'HEALTH'; 
        return view('modals.assess', compact('applicant_badge','app_ids','cv_ids','products','appl','test_available','count','section'));
    }

    
    

    public function requestTest(Request $request)
    {
        
        $comp_id = get_current_company()->id;
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

            foreach ( $request->app_ids as $key => $app_id) {
               $data = [
                    'location' => @$request->location,
                    'start_time' => @$request->start_time,
                    'end_time' => @$request->end_time,
                    'job_application_id' => $app_id,
                    'test_id' => $test['id'],
                    'test_name' => $test['name'],
                    'test_owner' => $test['owner'],
                    'order_id' => $order->id,
                
                ];
                            
                TestRequest::create($data);
            }
            
            // var_dump($data);
        }

        JobApplication::massAction( @$request->job_id,  @$request->cv_ids , 'ASSESSED' );

        $res = array();
        $res = ['total_amount'=>$request->total_amount, 'order_id'=>$order->id];
        return $res;

    }

    public function requestCheck(Request $request)
    {
        $comp_id = get_current_company()->id;
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

           

            foreach ( $request->app_ids as $key => $app_id) {

                 $data = [
                    'job_application_id' => $app_id,
                    'job_id' => @$request->job_id,
                    'ats_product_id' => $check['id'],
                    'cost' => $check['cost'],
                    'service_type' => @$request->service_type,
                    'created' => Carbon::now(),
                    'modified' => Carbon::now(),
                    'order_id' => $order->id
                
                ];
                            
                AtsRequest::create($data);
            }
                        
            
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
        

        JobApplication::massAction( @$request->job_id, @$request->cv_ids , 'INTERVIEWED' );

    }


    public function saveInterviewNote(Request $request)
    {

            // $data = [
            //     'location' => @$request->location,
            //     'message' => @$request->message,
            //     'date' => @$request->date
            // ];


            $data = array_merge( @$request->texts, ( (array) json_decode( @$request->radios ) )  );
            // var_dump( $data );
            $data['interview_date'] = Carbon::now();
            InterviewNotes::create($data);

        

        // JobApplication::massAction( @$request->job_id, [ @$request->cv_id ], 'INTERVIEWED' );

    }
    
    
    public function getMultipleApplicantBadge($action,$count)
    {
        return '<div class="row" >
      <div class="col-xs-12">
          <h5 class="text-center text-info text-brandon">'.$action.' '.$count.' applicants?</h5>
      </div>
    </div>';
        
    }
    
    public function getApplicantBadge($cv)
    {
        return view('modals.applicant_badge',compact('cv'))->render();
        
    }
}

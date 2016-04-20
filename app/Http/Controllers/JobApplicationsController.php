<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\JobApplication;
use App\Models\Job;
use App\Models\AtsRequest;
use App\Libraries\Solr;
use App\Models\AtsService;
use App\Models\AtsProduct;
use App\Models\TestRequest;
use App\Models\Interview;


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
        
        return view('applicant.assess', compact('appl', 'nav_type'));
    }

    public function activities($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'activities';
        
        return view('applicant.activities', compact('appl', 'nav_type'));
    }

    public function medicals($appl_id){

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        $nav_type = 'medicals';

        $requests = $appl->requests()->with('product.provider')->where('service_type', 'medicals')->get();

        
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

        $requests = $appl->requests()->with('product.provider')->where('service_type', 'background')->get();


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

        echo '<div class="job-item ">
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

        
    }


    public function modalComment(Request $request)
    {
        // $appl = JobApplication::with('job', 'cv')->find( $request->app_id );
        // echo "<pre>";
        // var_dump($appl);
        // echo "</pre>";
        // $applicant_badge = $this->getApplicantBadge( $request->cv_id );
        $applicant_badge = @$request->badge;
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;

        return view('modals.comment', compact('applicant_badge','app_id','cv_id'));
    }

    public function modalInterview(Request $request)
    {
        // $appl = JobApplication::with('job', 'cv')->find( $request->app_id );
        // echo "<pre>";
        // var_dump($appl);
        // echo "</pre>";
        // $applicant_badge = $this->getApplicantBadge( $request->cv_id );
        $applicant_badge = @$request->badge;
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);

        return view('modals.interview', compact('applicant_badge','app_id','cv_id','appl'));
    }

    
    public function modalShortlist(Request $request)
    {
        $applicant_badge = @$request->badge;
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);

        return view('modals.shortlist', compact('applicant_badge','app_id','cv_id','appl'));
    }

    public function modalReject(Request $request)
    {
        $applicant_badge = @$request->badge;
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);

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
        
        $applicant_badge = @$request->badge;
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        // $requests = $appl->requests()->with('product.provider')->where('service_type', 'background')->get();
        $test_available = true;
        // $services = AtsService::all()->toArray() ;

        $products = AtsProduct::all(); 
        return view('modals.assess', compact('applicant_badge','app_id','cv_id','products','appl','test_available'));
    }

    public function requestTest(Request $request)
    {
        
        foreach ($request->tests as $key => $test) {
            $data = [
                'location' => @$request->location,
                'start_time' => @$request->start_time,
                'end_time' => @$request->end_time,
                'job_application_id' => @$request->job_application_id,
                'location' => @$request->location,
                'test_id' => $test['id'],
                'test_name' => $test['name'],
                'test_owner' => $test['owner'],
            
            ];
                        
            TestRequest::create($data);
            // var_dump($data);
        }

        JobApplication::massAction( @$request->job_id, [ @$request->cv_id ], 'ASSESSED' );

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
    

    
    public function getApplicantBadge($cv_id)
    {
        return view('modals.applicant_badge')->render();
        
    }
}

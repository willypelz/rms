<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
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
use App\Models\JobActivity;
use App\Models\Cv;
use Carbon\Carbon;
use Auth;
use Excel;
use App;
use PDF;
use Curl;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Alchemy\Zippy\Zippy;
use Alchemy\Zippy\Adapter\ZipExtensionAdapter;
use Validator;
use File;
use App\Models\InterviewNoteOptions;
use App\Models\InterviewNoteValues;
use App\Models\InterviewNoteTemplates;
use App\Models\Message as CandidateMessage;
use App\Models\WorkflowStep;


class JobApplicationsController extends Controller
{
    private $search_params = [
        'q' => '*',
        'row' => 20,
        'start' => 0,
        'default_op' => 'AND',
        'search_field' => 'text',
        'show_expired' => false,
        'sort' => 'application_date+desc',
        'grouped' => false
    ];

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
    private $qualifications = [

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

    protected $mailer;

    private $sender;

    private $replyTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth', [
            'except' => [
                'saveTestResult'
            ]
        ]);
        $this->mailer = $mailer;

        if (Auth::check()) {
            $this->sender = (get_current_company()->slug != "" && get_current_company()->slug) ? get_current_company()->slug . '@seamlesshr.com' : 'support@seamlesshr.com';
            $this->replyTo = (get_current_company()->email) ? get_current_company()->email : 'support@seamlesshr.com';
        } else {
            $this->sender = 'support@seamlesshr.com';
            $this->replyTo = 'support@seamlesshr.com';
        }


        /*$cv = (object) [ "first_name" => "Emmanuel", "last_name" => "Okeleji", "email" => "emmanuel@insidify.com" ];

        $job = (object) [ "title" => "CEO", "company" => (object) [ "name" => "Insidify" ] ];
        $this->mailer->send('emails.new.reject_email', ['cv' => $cv, 'job' => $job], function (Message $m) use ($cv) {
                                $m->from('support@seamlesshr.com')->to($cv->email)->subject('Feedback');
                            });*/
    }

    public function assess($appl_id)
    {

        $appl = JobApplication::with('job.workflow.workflowSteps', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'assess';

        $requests = TestRequest::where('job_application_id', $appl_id)->with('product.provider')->get();

        // dd($appl->toArray());

        return view('applicant.assess', compact('appl', 'nav_type', 'requests'));
    }

    public function activities($appl_id)
    {

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        // dd($appl);
        $nav_type = 'activities';
        return view('applicant.activities', compact('appl', 'nav_type', 'result', 'application_statuses'));
    }

    public function medicals($appl_id)
    {

        $appl = JobApplication::with('job.workflow.workflowSteps', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'medicals';

        $requests = $appl->requests()->with('product.provider')->where('service_type', 'HEALTH')->get();


        return view('applicant.medicals', compact('appl', 'nav_type', 'requests'));
    }


    public function documents($appl_id)
    {

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'documents';

        $documents = CandidateMessage::where('job_application_id', $appl->id)
            ->where('attachment', '!=', '')
            ->where('user_id', null)
            ->get();


        return view('applicant.documents', compact('appl', 'nav_type', 'documents'));
    }

    public function notes($appl_id)
    {
        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'notes';

        // $interview_notes = $appl->interview_notes()->with('user')->get();
        // $interview_notes = InterviewNoteValues::with('interviewer')->where('job_application_id',
        //     $appl->id)->groupBy('interviewed_by')->get();

        $interview_note_categories = InterviewNoteValues::with('interviewer',
            'interview_note_option')->where('job_application_id',
            $appl->id)->get()->groupBy('interview_note_option.interview_note_template.name');


        return view('applicant.notes', compact('appl', 'nav_type', 'interview_note_categories'));
    }

    public function checks($appl_id)
    {

        $appl = JobApplication::with('job.workflow.workflowSteps', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'checks';

        $requests = $appl->requests()->with('product.provider')->where('service_type', 'BACKGROUND')->get();


        return view('applicant.checks', compact('appl', 'nav_type', 'requests'));
    }

    public function Profile($appl_id)
    {

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'profile';

        // dd($appl->toArray());

        return view('applicant.profile', compact('appl', 'nav_type'));

    }


    public function Messages($appl_id)
    {

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'messages';

        $messages = CandidateMessage::where('job_application_id', $appl->id)->get();
        return view('applicant.messages', compact('appl', 'nav_type', 'messages'));

    }


    public function sendMessage(Request $request)
    {

        if ($request->hasFile('attachment')) {
            $file_name = (@$request->attachment->getClientOriginalName());
            $fi = @$request->file('attachment')->getClientOriginalExtension();
            $attachment = $request->application_id . '-' . time() . '-' . $file_name;

            $upload = $request->file('attachment')->move(
                env('fileupload'), $attachment
            );
        } else {
            $attachment = '';
        }

        CandidateMessage::create([
            'job_application_id' => $request->application_id,
            'message' => $request->message,
            'attachment' => $attachment,
            'user_id' => Auth::user()->id
        ]);
        $application_id = $request->application_id;

        return redirect()->route('applicant-messages', ['appl_id' => $application_id]);

    }

    public function viewApplicants(Request $request)
    {
        //Check if he  is the owner of the job
        check_if_job_owner($request->jobID);

        $job = Job::with([
            'form_fields',
            'workflow.workflowSteps' => function ($q) {

                return $q->orderBy('order', 'asc');

            }
        ])->find($request->jobID);

        $active_tab = 'candidates';
        $status = '';
        $jobID = $request->jobID;

        $this->search_params['filter_query'] = @$request->filter_query;
        $this->search_params['start'] = $start = ($request->start) ? ($request->start * $this->search_params['row']) : 0;

        //If age is available
        if (@$request->age) {

            //2015-09-16T00:00:00Z
            $start_dob = explode(' ', Carbon::now()->subYears(@$request->age[0]))[0] . 'T23:59:59Z';
            $end_dob = explode(' ', Carbon::now()->subYears(@$request->age[1]))[0] . 'T00:00:00Z';

            $solr_age = [$start_dob, $end_dob];
        } else {
            $request->age = [env('AGE_START'), env('AGE_END')];
            $solr_age = null;
        }

        //If years of experience is available
        if (@$request->exp_years) {
            //2015-09-16T00:00:00Z
            $solr_exp_years = [@$request->exp_years[0], @$request->exp_years[1]];
        } else {
            $request->exp_years = [env('EXPERIENCE_START'), env('EXPERIENCE_END')];
            $solr_exp_years = null;
        }

        //If test score is available
        if (@$request->test_score) {
            //2015-09-16T00:00:00Z
            $solr_test_score = [@$request->test_score[0], @$request->test_score[1]];
        } else {
            $request->test_score = [40, 160];
            $solr_test_score = null;
        }

        //If video application score is available
        if (@$request->video_application_score) {
            //2015-09-16T00:00:00Z
            $solr_video_application_score = [
                @$request->video_application_score[0],
                @$request->video_application_score[1]
            ];
        } else {
            $request->video_application_score = [env('VIDEO_APPLICATION_START'), env('VIDEO_APPLICATION_END')];
            $solr_video_application_score = null;
        }

        $result = Solr::get_applicants(
            $this->search_params,
            $request->jobID,
            @$request->status,
            @$solr_age,
            @$solr_exp_years,
            @$solr_video_application_score,
            @$solr_test_score
        );

        $statuses = $job->workflow->workflowSteps()->pluck('slug');

        $application_statuses = get_application_statuses($result['facet_counts']['facet_fields']['application_status'],$request->jobID,
            $statuses);
//        $statuses_grouped = JobApplication::where('job_id',53)->select('status', \solrDB::raw('count(*) as total'))
//        ->groupBy('status')
//        ->pluck('total','status')->all();



        if (isset($request->status)) {
            $status = $request->status;
            if($request->status != "")
                $application_statuses['ALL'] = $application_statuses[$status];
        }

        $end = (($start + $this->search_params['row']) > intval($application_statuses['ALL'])) ? $application_statuses['ALL'] : ($start + $this->search_params['row']);
        // $showing = "Showing ".($start+1)." - ".$end." of ".$result['response']['numFound']." Applicants [Page ".floor($request->start + 1)."]";
        // dd($result);

        $showing = view('cv-sales.includes.top-summary', [
            'start' => ($start + 1),
            'end' => $end,
            'total' => $application_statuses['ALL'],
            'type' => $request->status,
            'page' => floor($request->start + 1),
            'filters' => $request->filter_query
        ])->render();
        $myJobs = Job::getMyJobs();

        $myFolders = array_unique(array_pluck(Solr::get_all_my_cvs($this->search_params, null,
            null)['response']['docs'], 'cv_source'));

        if (($key = array_search('Direct Application', $myFolders)) !== false) {
            unset($myFolders[$key]);
        }

        $states = $this->states;
        $qualifications = $this->qualifications;
        $grades = grades();

        if ($request->ajax()) {
            $search_results = view('job.board.includes.applicant-results-item',
                compact('job', 'active_tab', 'status', 'result', 'jobID', 'start', 'myJobs', 'myFolders',
                    'application_statuses', 'request'))->render();
            $search_filters = view('cv-sales.includes.search-filters', [
                'result' => $result,
                'search_query' => $request->search_query,
                'status' => $status,
                'age' => @$request->age,
                'exp_years' => @$request->exp_years,
                'job' => $job,
                'video_application_score' => @$request->video_application_score,
                'test_score' => @$request->test_score
            ])->render();

            return response()->json([
                'search_results' => $search_results,
                'search_filters' => $search_filters,
                'showing' => $showing,
                'count' => $result['response']['numFound']
            ]);

        } else {
            $age = [env('AGE_START'), env('AGE_END')];
            $exp_years = [env('EXPERIENCE_START'), env('EXPERIENCE_END')];
            $video_application_score = [env('VIDEO_APPLICATION_START'), env('VIDEO_APPLICATION_END')];
            $test_score = [40, 160];

            return view('job.board.candidates',
                compact('job',
                    'active_tab',
                    'status',
                    'result',
                    'application_statuses',
                    'jobID',
                    'start',
                    'age',
                    'exp_years',
                    'test_score',
                    'showing',
                    'myJobs',
                    'myFolders', 'application_statuses', 'job',
                    'video_application_score', 'request', 'states', 'qualifications', 'grades'));
        }


    }

    public function downloadApplicantSpreadsheet(Request $request)
    {

        //Check if you should have access to the excel
        check_if_job_owner($request->jobId);

        $job = Job::find($request->jobId);



        $this->search_params['filter_query'] = @$request->filter_query;
        $this->search_params['row'] = 2147483647;


        //If age is available
        if (@$request->age) {
            $date = Carbon::now();
            //2015-09-16T00:00:00Z
            $start_dob = explode(' ', $date->subYears(@$request->age[0]))[0] . 'T23:59:59Z';
            $end_dob = explode(' ', $date->subYears(@$request->age[1]))[0] . 'T00:00:00Z';

            $solr_age = [$start_dob, $end_dob];
            // dd($request->age, $start_dob, $end_dob);
        } else {
            $request->age = [15, 65];
            $solr_age = null;
        }


        //If years of experience is available
        if (@$request->exp_years) {
            //2015-09-16T00:00:00Z

            $solr_exp_years = [@$request->exp_years[0], @$request->exp_years[1]];
        } else {
            $request->exp_years = [0, 40];
            $solr_exp_years = null;
        }

        //If test score is available
        if (@$request->test_score) {
            //2015-09-16T00:00:00Z

            $solr_test_score = [@$request->test_score[0], @$request->test_score[1]];
        } else {
            $request->test_score = [40, 160];
            $solr_test_score = null;
        }

        //If video application score is available
        if (@$request->video_application_score) {
            //2015-09-16T00:00:00Z

            $solr_video_application_score = [
                @$request->video_application_score[0],
                @$request->video_application_score[1]
            ];
        } else {
            $request->video_application_score = [env('VIDEO_APPLICATION_START'), env('VIDEO_APPLICATION_END')];
            $solr_video_application_score = null;
        }


        $result = Solr::get_applicants($this->search_params, $request->jobId, @$request->status, @$solr_age,
            @$solr_exp_years, @$solr_video_application_score, @$solr_test_score);


        $data = $result['response']['docs'];
        $other_data = [

            'company' => get_current_company()->name,
            'user' => Auth::user()->name,
            'job_title' => $job->title,
        ];

        $excel_data = [];

        foreach ($data as $key => $value) {
            if (!empty($request->cv_ids) && !in_array($value['id'], $request->cv_ids)) {
                continue;
            }
            $tests = "";

            if (@$value['test_status']) {
                foreach (@$value['test_status'] as $key2 => $test_status) {

                    if ($test_status == 'COMPLETED') {
                        $tests .= @$value['test_name'][$key2] . "(" . @$value['test_score'][$key2] . ') ';
                    }
                }
            }

            $excel_data[] = [
                "FIRSTNAME" => $value['first_name'],
                "LASTNAME" => @$value['last_name'],
                "LAST POSITION HELD" => @$value['last_position'],
                "HEADLINE" => @$value['headline'][0],
                "GENDER" => @$value['gender'],
                "MARITAL STATUS" => @$value['marital_status'],
                "DATE OF BIRTH" => substr(@$value['dob'], 0, 10),
                // "AGE" => '',
                "LOCATION" => @$value['state'],
                "EMAIL" => @$value['email'],
                "PHONE" => @$value['phone'],
                "COVER NOTE" => @$value['cover_note'][0],
                "HIGHEST EDUCATION" => @$value['highest_qualification'],
                "LAST COMPANY WORKED AT" => @$value['last_company_worked'],
                "YEARS OF EXPERIENCE" => @$value['years_of_experience'],
                "WILLING TO RELOCATE?" => ($value['willing_to_relocate'] == "true") ? 'Yes' : 'No',
                "TESTS" => $tests,


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

        Excel::create('Applicants Report: ' . $other_data['job_title'],
            function ($excel) use ($excel_data, $other_data) {
                // Set the title
                $excel->setTitle('Applicants Report: ' . $other_data['job_title']);
                $excel->setCreator($other_data['user'])->setCompany($other_data['company']);
                // $excel->setDescription('report file');

                $excel->sheet('Report', function ($sheet) use ($excel_data, $other_data) {


                    // first row styling and writing content
                    // $sheet->mergeCells('A1:W1');
                    // $sheet->row(1, function ($row) {
                    //     $row->setFontFamily('Comic Sans MS');
                    //     $row->setFontSize(30);
                    // });

                    // $sheet->row(1, array('Some big header here'));

                    $sheet->fromArray($excel_data, null, 'A1', false, true);
                    $sheet->cells('A1:P1', function ($cells) {
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

    public function downloadApplicantCv(Request $request)
    {
        //Check if you should have access to the excel
        check_if_job_owner($request->jobId);

        $job = Job::find($request->jobId);

        // dd( $job );

        $this->search_params['filter_query'] = @$request->filter_query;
        $this->search_params['row'] = 2147483647;


        //If age is available
        if (@$request->age) {
            $date = Carbon::now();
            //2015-09-16T00:00:00Z
            $start_dob = explode(' ', $date->subYears(@$request->age[0]))[0] . 'T23:59:59Z';
            $end_dob = explode(' ', $date->subYears(@$request->age[1]))[0] . 'T00:00:00Z';

            $solr_age = [$start_dob, $end_dob];
            // dd($request->age, $start_dob, $end_dob);
        } else {
            $request->age = [15, 65];
            $solr_age = null;
        }

        //If years of experience is available
        if (@$request->exp_years) {
            //2015-09-16T00:00:00Z

            $solr_exp_years = [@$request->exp_years[0], @$request->exp_years[1]];
        } else {
            $request->exp_years = [0, 40];
            $solr_exp_years = null;
        }

        //If test score is available
        if (@$request->test_score) {
            //2015-09-16T00:00:00Z

            $solr_test_score = [@$request->test_score[0], @$request->test_score[1]];
        } else {
            $request->test_score = [40, 160];
            $solr_test_score = null;
        }

        //If video application score is available
        if (@$request->video_application_score) {
            //2015-09-16T00:00:00Z

            $solr_video_application_score = [
                @$request->video_application_score[0],
                @$request->video_application_score[1]
            ];
        } else {
            $request->video_application_score = [env('VIDEO_APPLICATION_START'), env('VIDEO_APPLICATION_END')];
            $solr_video_application_score = null;
        }


        $result = Solr::get_applicants($this->search_params, $request->jobId, @$request->status, @$solr_age,
            @$solr_exp_years, @$solr_video_application_score, @$solr_test_score);

        $data = $result['response']['docs'];
        $other_data = [

            'company' => get_current_company()->name,
            'user' => Auth::user()->name,
            'job_title' => $job->title,
        ];

        // $zippy = Zippy::load();

        $path = public_path('uploads/tmp/');

        $filename = Auth::user()->id . "_" . get_current_company()->id . "_" . time() . ".zip";
        //$archive = $zippy->create(  $path.$filename );

        $cvs = array_pluck($data, 'cv_file');
        $ids = array_pluck($data, 'id');


        //Check for selected cvs to download and append path to it
        $cvs = array_map(function ($cv, $id) use ($request) {

            if (!empty($request->cv_ids) && !in_array($id, $request->cv_ids)) {
                return null;
            }

            if (!file_exists(public_path('uploads/CVs/') . $cv)) {
                return null;
            }

            if (is_null($cv) or $cv == "") {
                return null;
            }

            return public_path('uploads/CVs/') . $cv;
        }, $cvs, $ids);

        //Remove nulls
        $cvs = array_filter($cvs, function ($var) {
            return !is_null($var);
        });

        //$archive->addMembers($cvs, $recursive = false );

        $zipper = new \Chumper\Zipper\Zipper;
        @$zipper->make($path . $filename)->add($cvs)->close();

        return Response::download($path . $filename, 'Cv.zip', ['Content-Type' => 'application/octet-stream']);

    }

    public function massAction(Request $request)
    {

        JobApplication::massAction($request->job_id, $request->cv_ids, $request->status, $request->step_id);


        //MAT: ignore the rejected part of the code for now
        switch ($request->status) {
            case 'REJECTED':
                $appls = JobApplication::with('cv', 'job', 'job.company')->whereIn('id', $request->app_ids)->get();
                // dd( $appls );

                foreach ($appls as $key => $appl) {
                    $cv = $appl->cv;
                    $job = $appl->job;
                    $this->mailer->send('emails.new.reject_email', ['cv' => $cv, 'job' => $job],
                        function (Message $m) use ($cv) {
                            $m->from($this->sender, get_current_company()->name)
                                ->replyTo($this->replyTo, get_current_company()->name)
                                ->to($cv->email)
                                ->subject('Feedback');
                        });
                }
                break;
            case 'ALL':

                break;
            case 'PENDING':

                break;

            default:
                $this->sendWorkflowStepNotification($request->app_ids, $request->step_id);
                break;
        }
        Solr::update_core();
        return save_activities($request->status, $request->job_id, $request->app_ids);
    }

    public function writeReview(Request $request)
    {
        return save_activities('REVIEW', $request->job_id, $request->app_ids, $request->comment);
    }

    public function getAllApplicantStatus(Request $request)
    {
        $job = Job::with(['form_fields', 'workflow.workflowSteps'])->find($request->job_id);
//        $result = Solr::get_applicants($this->search_params,$request->job_id);
        $statuses = $job->workflow->workflowSteps()->pluck('slug');

        $application_statuses = get_application_statuses([],$request->job_id,
            $statuses);


        return view('job.board.includes.applicant-status', compact('application_statuses', 'result', 'job'));
    }

    public function JobListData(Request $request)
    {
        $result = Solr::get_applicants($this->search_params, $request->job_id, @$request->status);
        $application_statuses = get_application_statuses($result['facet_counts']['facet_fields']['application_status'],$request->job_id,
            $statuses = $request->workflow_steps);

        if ($request->type == 'job_view') {
            $total_applicants = ($result['response']['numFound']);
            echo $total_applicants;
            // exit;
        }

        $stats = '';
        foreach ($application_statuses as $key => $value) {
            $stats .= '<div class="job-item">'
                . '<span class="number">' . $value . '</span>'
                . '<br/>'
                . $key
                . '</div>';
        }

        /*$stats = '<div class="job-item ">
                    <span class="number">' . $application_statuses['HIRED'] . '</span><br/>Hired
                </div>
                <div class="job-item ">
                    <span class="number">' . $application_statuses['ASSESSED'] . '</span><br/>Tested
                </div>
                <div class="job-item ">
                    <span class="number">' . $application_statuses['INTERVIEWED'] . '</span><br/>Interviewed
                </div>
                <div class="job-item ">
                    <span class="number text-muted">' . $application_statuses['SHORTLISTED'] . '</span><br/>Shortlisted
                </div>
                <div class="job-item  purple">
                    <span class="number text-muted">' . $result['response']['numFound'] . '</span><br/>All
                </div>';*/

        // dd($stats);
        echo $stats;
    }

    public function getJobsData(Request $request)
    {
        $jobs_data = [];

        if (count($jobs_ids = $request->input('jobs_ids')) > 0) {
            foreach ($jobs_ids as $job_id) {
                $job_response_data = [
                    'id' => $job_id,
                    'html_data' => ''
                ];

                $job = Job::with([
                    'workflow.workflowSteps' => function ($q) {
                        return $q->orderBy('order', 'asc');
                    }
                ])->find($job_id);

                $result = Solr::get_applicants($this->search_params, $job_id,
                    ''); // status parater value is formerly : @$request->status
                $application_statuses = get_application_statuses($result['facet_counts']['facet_fields']['application_status'],$job_id,
                    $statuses = $job->workflow->workflowSteps()->pluck('slug'));


                foreach ($application_statuses as $key => $value) {
                    $job_response_data['html_data'] .= '<div class="job-item">'
                        . '<span class="number">' . $value . '</span>'
                        . '<br/>'
                        . $key
                        . '</div>';
                }

                $jobs_data[] = $job_response_data;
            }
        }

        return response()->json($jobs_data);
    }

    public function JobViewData(Request $request)
    {


        $result = Solr::get_applicants($this->search_params, $request->job_id, @$request->status);
        $total_applicants = ($result['response']['numFound']);
        $matching = 10000;

        $job = Job::find($request->job_id);

        $now = time(); // or your date as well
        $your_date = strtotime($job->post_date);
        $datediff = $now - $your_date;
        $open_days = floor($datediff / (60 * 60 * 24));

        $amount_spent = 0;

        $stats = '<table class="table table-bordered">
                            <tbody>
                        <tr>
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="' . route('job-candidates',
                [$job->id]) . ' ">' . $total_applicants . '</a></h1><small class="text-muted">Applicants</small></td>
                            <!--td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">' . $matching . '</a></h1><small class="text-muted">Matching Candidates</small></td-->
                        </tr>
                        <tr>
                            <td class="text-center"><h1 class="no-margin text-muted">' . $open_days . '</h1><small class="text-muted">Days Opened</small></td>
                            <!--td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">' . $amount_spent . '</a></h1><small class="text-muted">Amount Spent</small></td-->
                        </tr>
                        </tbody>
                        </table>';
        echo $stats;

    }


    public function modalComment(Request $request)
    {
        $modalVars = $this->modalActions('Interview', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        $jobID = $appl->job->id;

        return view('modals.comment', compact('applicant_badge', 'app_ids', 'cv_ids', 'jobID', 'appl'));
    }

    public function modalDossier(Request $request)
    {
        $modalVars = $this->modalActions('Download Dossier', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        $jobID = $appl->job->id;
        $comments = JobActivity::with('user', 'application.cv', 'job')->where('activity_type',
            'REVIEW')->where('job_application_id', $appl->id)->get();
        $notes = InterviewNotes::with('user')->where('job_application_id', $appl->id)->get();

        return view('modals.dossier',
            compact('applicant_badge', 'app_ids', 'cv_ids', 'jobID', 'appl', 'comments', 'notes'));
    }

    public function deleteTmpFiles()
    {
        $path = public_path('uploads/tmp/');
        File::deleteDirectory($path, true);
    }

    public function downloadDossier(Request $request)
    {
        $modalVars = $this->modalActions('Download Dossier', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        $jobID = $appl->job->id;
        check_if_job_owner($jobID);

        $comments = JobActivity::with('user', 'application.cv', 'job')->where('activity_type',
            'REVIEW')->where('job_application_id', $appl->id)->get();
        $notes = InterviewNotes::with('user')->where('job_application_id', $appl->id)->get();
        $interview_notes = InterviewNoteValues::with('interviewer',
            'interview_note_option')->where('job_application_id', $appl->id)->get()->groupBy('interviewed_by');
// dd( $interview_notes );
        //To file
        // $html = view('modals.inc.dossier-content', compact('applicant_badge','app_ids','cv_ids','jobID','appl','comments','interview_notes'))->render();
        $path = public_path('uploads/tmp/');

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML(view('modals.inc.dossier-content',
            compact('applicant_badge', 'app_ids', 'cv_ids', 'jobID', 'appl', 'comments', 'interview_notes'))->render());
        $pdf->setTemporaryFolder($path);
        $pdf->save($path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' dossier.pdf', true);


        $filename = $appl->cv->first_name . ' ' . $appl->cv->last_name . ".zip";
        $dossier_local_file = $path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' dossier.pdf';
        $cv_local_file = @$path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' cv - ' . $appl->cv->cv_file;

        $files_to_archive = [$dossier_local_file];
        //get cv
        if (!file_exists(public_path('uploads/CVs/') . $appl->cv->cv_file)) {
            $cv = null;
        } else {
            if (is_null($appl->cv->cv_file) or $appl->cv->cv_file == "") {
                $cv = null;
            } else {
                $cv = $appl->cv->cv_file;
                $cv_file = public_path('uploads/CVs/') . $cv;
                copy($cv_file, $cv_local_file);
                $files_to_archive[] = $cv_local_file;
            }
        }

        // dump( $appl->cv->cv_file );

        $test_path = "http://seamlesstesting.com/test/combined/pdf/" . $appl->id;
        $test_local_file = $path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' tests.pdf';
        // Response::download($test_path, $appl->cv->first_name.' '.$appl->cv->last_name. ' tests.pdf');


        if (@copy($test_path, $test_local_file)) {
            //if test exists
            if ($test_local_file) {
                $files_to_archive[] = $test_local_file;
            }

        }
        $timestamp = " " . time() . " ";

        $zipper = new \Chumper\Zipper\Zipper;
        @$zipper->make($path . $timestamp . $filename)->add($files_to_archive)->close();


//         File::delete( $files_to_archive );

        return Response::download($path . $timestamp . $filename, $filename,
            ['Content-Type' => 'application/octet-stream']);


        // $pdf = PDF::loadView('modals.inc.dossier-content', compact('applicant_badge','app_ids','cv_ids','jobID','appl','comments','notes'));
        // return $pdf->download('dossier.pdf');
        //
        // $html = view('modals.inc.dossier-content', compact('applicant_badge','app_ids','cv_ids','jobID','appl','comments','notes'))->render();
        // $pdf = PDF::loadHTML($html);

        // // return $pdf->download('dossier.pdf');
        // return $pdf->stream();
        // // echo $html;
        // return view('modals.inc.dossier-content', compact('applicant_badge','app_ids','cv_ids','jobID','appl','comments','notes'));
    }


    public function modalInterview(Request $request)
    {
        $modalVars = $this->modalActions('Interview', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        $step = $request->stepSlug;
        $stepId = $request->stepId;

        return view('modals.interview', compact('applicant_badge', 'app_ids', 'cv_ids', 'appl', 'step', 'stepId'));
    }

    public function modalInterviewNotes(Request $request)
    {

        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);

        $notes = InterviewNotes::where('job_application_id', $app_id)->where('interviewer_id',
            @Auth::user()->id)->get();

        $note = InterviewNotes::where('job_application_id', $app_id)->where('id',
            @$request->interview_id)->get()->first();


        // dd($note, $request->interview_id, count($notes), count($note));

        return view('modals.interview-notes', compact('applicant_badge', 'app_id', 'cv_id', 'appl', 'notes', 'note'));
    }


    public function modalStepAction(Request $request, $step, $stepSlug, $stepId)
    {
        $modalVars = $this->modalActions($step, $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        return view('modals.stepAction', compact(
            'applicant_badge',
            'app_ids',
            'cv_ids',
            'step',
            'stepSlug',
            'stepId',
            'appl'
        ));
    }

    public function modalShortlist(Request $request)
    {
        $modalVars = $this->modalActions('Shortlist', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        return view('modals.shortlist', compact('applicant_badge', 'app_ids', 'cv_ids', 'appl'));
    }

    public function modalHire(Request $request)
    {
        $modalVars = $this->modalActions('Hire', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }


        return view('modals.hire', compact('applicant_badge', 'app_ids', 'cv_ids', 'appl'));
    }


    public function modalReturnToAll(Request $request)
    {

        $modalVars = $this->modalActions('Return', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }


        return view('modals.return_to_all', compact('applicant_badge', 'app_ids', 'cv_ids', 'appl'));
    }

    public function modalAddToWaiting(Request $request)
    {

        $modalVars = $this->modalActions('Waiting List: Add', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }


        return view('modals.add_to_waiting', compact('applicant_badge', 'app_ids', 'cv_ids', 'appl'));
    }


    public function modalReject(Request $request)
    {
        $modalVars = $this->modalActions('Reject', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        return view('modals.reject', compact('applicant_badge', 'app_ids', 'cv_ids', 'appl'));
    }


    public function modalApprove(Request $request)
    {
        $stepId = $request->stepId;
        if ($request->isMethod('post')) {

            $JA = JobApplication::whereIn('cv_id', $request->cv_ids)->update(['is_approved' => true]);

            $this->sendWorkflowStepNotification($request->app_ids, $stepId);

            Solr::update_core();

            return ($JA) ? 'true' : 'false';

        }


        $modalVars = $this->modalActions('Approve', $request->cv_id, $request->app_id);

        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        return view('modals.approve', compact('applicant_badge', 'app_ids', 'cv_ids', 'appl', 'stepId'));
    }

    private function modalActions($action, $cv_ids, $app_ids)
    {

        $app_ids = explode(',', @$app_ids);
        $cv_ids = explode(',', @$cv_ids);
        $appl = JobApplication::with('job', 'cv')->find($app_ids[0]);

        if (count($cv_ids) > 1 && count($app_ids) > 1) {
            $applicant_badge = @$this->getMultipleApplicantBadge($action, count($cv_ids));
        } else {
            if (count($cv_ids) == 1 && count($app_ids) == 1) {

                $applicant_badge = @$this->getApplicantBadge($appl->cv);
            } else {
                return " There an error. Please contact the administrator";
            }
        }

        return [
            'applicant_badge' => $applicant_badge,
            'app_ids' => $app_ids,
            'cv_ids' => $cv_ids,
            'appl' => $appl,
        ];

    }


    public function modalAssess(Request $request)
    {
        $modalVars = $this->modalActions('Test', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        $test_available = true;
        $count = count($cv_ids);
        $products = get_current_company()->tests;
        // $products = AtsProduct::where('company_id', get_current_company()->tests)->get();
        $section = 'TEST';
        $type = "TEST";
        $done_test = array_pluck(TestRequest::whereIn('job_application_id', $app_ids)->get()->toArray(), 'id');

        $step = $request->stepSlug;
        $stepId = $request->stepId;

        return view('modals.assess',
            compact('applicant_badge', 'app_ids', 'cv_ids', 'products', 'appl', 'test_available', 'section', 'count',
                'type', 'step', 'stepId'));
    }

    public function modalTestResult(Request $request)
    {
        $modalVars = $this->modalActions('Test Result', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        $section = 'TEST RESULT';
        return view('modals.test-result', compact('app_ids', 'cv_ids'));
    }

    public function modalBackgroundCheck(Request $request)
    {


        $modalVars = $this->modalActions('Background Check for', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        $products = AtsProduct::all();
        $count = count($cv_ids);

        $section = 'BACKGROUND';
        $type = "BACKGROUND_CHECK";

        $step = $request->stepSlug;
        $stepId = $request->stepId;

        return view('modals.assess',
            compact('applicant_badge', 'app_ids', 'cv_ids', 'products', 'appl', 'test_available', 'count', 'section',
                'type', 'step', 'stepId'));
    }


    public function modalMedicalCheck(Request $request)
    {

        $modalVars = $this->modalActions('Health Check for', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        $products = AtsProduct::all();
        $count = count($cv_ids);

        $section = 'HEALTH';
        $type = "MEDICAL_CHECK";

        $step = $request->stepSlug;
        $stepId = $request->stepId;

        return view('modals.assess',
            compact('applicant_badge', 'app_ids', 'cv_ids', 'products', 'appl', 'test_available', 'count', 'section',
                'type', 'step', 'stepId'));
    }


    public function requestTest(Request $request)
    {

        $comp_id = get_current_company()->id;
        $invoice_no = '#' . mt_rand();

        $test_ids = [];


        $order = Order::firstOrCreate([
            'company_id' => $comp_id,
            'order_date' => date('Y-m-d H:i:s'),
            'total_amount' => $request->total_amount,
            'invoice_no' => $invoice_no,
            'type' => $request->type

        ]);

        $transaction = Transaction::firstOrCreate([
            'order_id' => $order->id,
            'status' => 'false',
            'message' => 'Transaction Not Found'
        ]);


        foreach ($request->tests as $key => $test) {

            $orderItems = OrderItem::firstOrCreate([
                'order_id' => $order->id,
                'itemId' => $test['id'],
                'type' => $request->type,
                'name' => $test['name'],
                'price' => $test['cost']
            ]);

            foreach ($request->app_ids as $key3 => $app_id) {
                $data = [
                    'location' => @$request->location,
                    'start_time' => @$request->start_time,
                    'end_time' => @$request->end_time,
                    'job_application_id' => $app_id,
                    'test_id' => $test['id'],
                    'test_name' => $test['name'],
                    'test_owner' => $test['owner'],
                    // 'order_id' => $order->id,
                    'order_id' => null,
                    // 'status'=> 'ORDER'
                    'status' => 'PENDING'

                ];

                // save_activities('TEST_ORDER', @$request->job_id, $request->app_ids );

                $mustBeUnique = ['job_application_id' => $app_id, 'test_id' => $test['id']];

                $test_request = TestRequest::updateOrCreate($mustBeUnique, $data);
                $test_ids[] = $test_request->id;

                $app = JobApplication::with('cv')->find($app_id);

                JobApplication::massAction(@$request->job_id, @$request->cv_ids, $request->step, $request->stepId);
                $response = Curl::to('https://seamlesstesting.com/test-request')
                    ->withData([
                        'job_title' => $app->job->title,
                        'test_id' => $data['test_id'],
                        'job_application_id' => $app_id,
                        'applicant_name' => ucwords(@$app->cv->first_name . " " . @$app->cv->last_name),
                        'applicant_email' => $app->cv->email,
                        'employer_name' => get_current_company()->name,
                        'employer_email' => get_current_company()->email,
                        'start_time' => $data['start_time'],
                        'end_time' => $data['end_time'],
                        'webhook_url' => route('save-test-result'),
                    ])
                    ->post();
                // Leave this next line untouched, its imperative
                dump($response);
            }

            // var_dump($data);
        }


        $res = [];
        $res = ['total_amount' => $request->total_amount, 'order_id' => $order->id, 'type_ids' => $test_ids];
        return $res;

    }

    public function saveTestResult(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'job_application_id' => 'required',
                'test_id' => 'required',
                'actual_start_time' => 'required',
                'actual_end_time' => 'required',
                'score' => 'required',
                'status' => 'required'

            ]);

            if ($validator->fails()) {
                dd($validator->messages());
            } else {
                $app = JobApplication::with('job')->where('id', $request->job_application_id)->first();

                save_activities('TEST_RESULT', @$app->job->id, $request->job_application_id);

                TestRequest::where('job_application_id', $request->job_application_id)
                    ->where('test_id', $request->test_id)
                    ->update([
                        'actual_start_time' => $request->actual_start_time,
                        'actual_end_time' => $request->actual_end_time,
                        'score' => $request->score,
                        'result_comment' => @$request->result_comment,
                        'status' => @$request->status
                    ]);
                Solr::update_core();

            }


        }


    }

    public function requestCheck(Request $request)
    {
        $comp_id = get_current_company()->id;
        $invoice_no = '#' . mt_rand();
        $check_ids = [];

        $order = Order::firstOrCreate([
            'company_id' => $comp_id,
            'order_date' => date('Y-m-d H:i:s'),
            'total_amount' => $request->total_amount,
            'invoice_no' => $invoice_no,
            'type' => $request->type
        ]);

        $transaction = Transaction::firstOrCreate([
            'order_id' => $order->id,
            'status' => 'false',
            'message' => 'Transaction Not Found'
        ]);

        foreach ($request->checks as $key => $check) {

            $orderItems = OrderItem::firstOrCreate([
                'order_id' => $order->id,
                'itemId' => $check['id'],
                'type' => $request->type,
                'name' => $check['name'],
                'price' => $check['cost']
            ]);


            foreach ($request->app_ids as $key => $app_id) {

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

                $check = AtsRequest::create($data);
                $check_ids[] = $check->id;
            }


            // var_dump($data);

        }
        $res = [];
        $res = ['total_amount' => $request->total_amount, 'order_id' => $order->id, 'type_ids' => $check_ids];
        return $res;
        // JobApplication::massAction( @$request->job_id, [ @$request->cv_id ], 'ASSESSED' );
    }


    public function Checkout(Request $request)
    {
        // dd($request->total_amount);


    }

    public function inviteForInterview(Request $request)
    {


        $appls = JobApplication::with('cv', 'job', 'job.company')->whereIn('id', $request->app_ids)->get();


        foreach ($appls as $key => $appl) {
            $cv = $appl->cv;
            $job = $appl->job;

            $data = [
                'location' => @$request->location,
                'message' => @$request->message,
                'date' => @$request->date,
                'job_application_id' => $appl->id
            ];


            Interview::create($data);

            if ($appl->job->company->id == 96) {
                $this->mailer->send('emails.new.interview_invitation_ibfc',
                    ['cv' => $cv, 'job' => $job, 'interview' => (object)$data], function (Message $m) use ($cv) {
                        $m->from('support@seamlesshr.com')->to($cv->email)->subject('Interview Invitation');
                    });
            } else {
                $this->mailer->send('emails.new.interview_invitation',
                    ['cv' => $cv, 'job' => $job, 'interview' => (object)$data], function (Message $m) use ($cv) {
                        $m->from($this->sender, get_current_company()->name)
                            ->replyTo($this->replyTo, get_current_company()->name)
                            ->to($cv->email)
                            ->subject('Interview Invitation');
                    });
            }

        }


        save_activities('INTERVIEWED', $request->job_id, $request->app_ids);

        JobApplication::massAction(@$request->job_id, @$request->cv_ids, $request->step, $request->stepId);

    }


    public function saveInterviewNote(Request $request)
    {

        $data = array_merge(@$request->texts, ((array)json_decode(@$request->radios)));
        // var_dump( $data );
        $data['interview_date'] = Carbon::now();
        InterviewNotes::create($data);
    }

    public function viewInterviewNoteTemplates(Request $request)
    {

        $interview_note_templates = InterviewNoteTemplates::with('options')->where('company_id',
            get_current_company()->id)->get();
        return view('job.interview-note-templates', compact('interview_note_templates'));
    }

    public function editInterviewNoteTemplate(Request $request)
    {


        if ($request->isMethod('post')) {
            InterviewNoteTemplates::where('id', $request->id)->where('company_id', get_current_company()->id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            \Session::flash('status', 'Updated Successfully');
        }

        $interview_note_template = InterviewNoteTemplates::where('id', $request->id)->where('company_id',
            get_current_company()->id)->first();

        return view('job.interview-note-template-edit', compact('interview_note_template'));
    }


    public function createInterviewNoteTemplate(Request $request)
    {
        // $interview_note_options = InterviewNoteOptions::where('company_id',get_current_company()->id )->get();


        if ($request->isMethod('post')) {
            InterviewNoteTemplates::create([
                'name' => $request->name,
                'description' => $request->description,
                'company_id' => get_current_company()->id
            ]);

            \Session::flash('status', 'Create Successfully');
        }


        return view('job.interview-note-template-create', compact('interview_note_option'));
    }

    public function viewInterviewNoteOptions(Request $request)
    {
        $interview_template = InterviewNoteTemplates::where('id', $request->interview_template_id)->where('company_id',
            get_current_company()->id)->first();

        $interview_note_options = InterviewNoteOptions::where('company_id',
            get_current_company()->id)->where('interview_template_id', $request->interview_template_id)->get();

        $interview_template_id = $request->interview_template_id;
        return view('job.interview-note-options',
            compact('interview_note_options', 'interview_template_id', 'interview_template'));
    }

    public function editInterviewNoteOptions(Request $request)
    {
        $interview_template = InterviewNoteTemplates::where('id',
            $request->interview_template_id)->where('company_id', get_current_company()->id)->first();
        $interview_template_id = $request->interview_template_id;
        if ($request->isMethod('post')) {
            InterviewNoteOptions::where('id', $request->id)->where('company_id', get_current_company()->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'weight' => $request->weight,
            ]);

            \Session::flash('status', 'Updated Successfully');
        }

        $interview_note_option = InterviewNoteOptions::where('id', $request->id)->where('company_id',
            get_current_company()->id)->first();

        return view('job.interview-note-option-edit',
            compact('interview_note_option', 'interview_template_id', 'interview_template'));
    }


    public function createInterviewNoteOptions(Request $request)
    {
        // $interview_note_options = InterviewNoteOptions::where('company_id',get_current_company()->id )->get();

        $interview_template = InterviewNoteTemplates::where('id',
            $request->interview_template_id)->where('company_id', get_current_company()->id)->first();
        $interview_template_id = $request->interview_template_id;

        if ($request->isMethod('post')) {
            InterviewNoteOptions::create([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'weight' => $request->weight,
                'company_id' => get_current_company()->id,
                'interview_template_id' => $request->interview_template_id
            ]);

            \Session::flash('status', 'Create Successfully');
        }


        return view('job.interview-note-option-create',
            compact('interview_note_option', 'interview_template_id', 'interview_template'));
    }


    public function getMultipleApplicantBadge($action, $count)
    {
        return '<div class="row" >
      <div class="col-xs-12">
          <h5 class="text-center text-info text-brandon">' . $action . ' ' . $count . ' applicants?</h5>
      </div>
    </div>';

    }

    public function getApplicantBadge($cv)
    {

        return view('modals.applicant_badge', compact('cv'))->render();

    }

    public function takeInterviewNote(Request $request)
    {
        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);

        $interview_note_options = $this->getInterviewNoteOption($appl->job->id, $request->id);

        $interview_template_id = $request->id;

        if (@$request->readonly) {
            $readonly = true;
            $interview_note = InterviewNoteValues::with('interviewer')->where('job_application_id',
                $appl->id)->where('interviewed_by', $request->interviewed_by)->get()->pluck('value',
                'interview_note_option_id');
        } else {
            $readonly = false;
        }

        if ($request->isMethod('post')) {
            $data = array_merge(json_decode($request->radios, true), json_decode($request->texts, true));

            $interview_note_values = [];
            $score = 0;
            $correct_count = 0;
            foreach ($interview_note_options as $key => $option) {

                $interview_note_values[] = [
                    'interview_note_option_id' => $option->id,
                    'value' => $data['option_' . $option->id],
                    'job_application_id' => $appl->id,
                    'interviewed_by' => @Auth::user()->id,
                    'created_at' => Carbon::now(),
                ];


            }

            InterviewNoteValues::insert($interview_note_values);


        }

        return view('modals.interview-notes',
            compact('applicant_badge', 'app_id', 'cv_id', 'appl', 'interview_note_options', 'interview_note',
                'interview_template_id', 'readonly'));

    }


    private function getInterviewNoteOption($jobID, $interview_template_id)
    {

        $interview_note_options = InterviewNoteOptions::where('company_id',
            get_current_company()->id)->where('interview_template_id', $interview_template_id)->get();

        if (empty($interview_note_options->toArray())) {
            $interview_note_options = InterviewNoteOptions::where('job_id', null)->get();
        }

        return $interview_note_options;
    }

    /**
     * @param $app_ids
     * @param $status
     * @param $step_id
     */
    public function sendWorkflowStepNotification($app_ids, $step_id)
    {

        $appls = JobApplication::with('cv', 'job', 'job.company')->whereIn('id', $app_ids)->get();
        $step = WorkflowStep::find($step_id);


        if ($step->visible_to_applicant && !$step->requires_approval) {
            foreach ($appls as $key => $appl) {
                $cv = $appl->cv;
                $job = $appl->job;

                $replacements = [
                    '{applicant_name}' => $cv->name,
                    '{company_name}' => get_current_company()->name,
                    '{job_detail}' => $job->details,
                    '{job_title}' => $job->title,
                ];
                $message_content = $step->message_template;

                foreach ($replacements as $key => $replacement) {
                    $message_content = str_replace($key, $replacement, $message_content);
                }
                if(!is_null($cv->email))
                {
                    $this->mailer->send('emails.new.step_moved', ['cv' => $cv, 'job' => $job, 'step' => $step,'message_content' => $message_content],
                        function (Message $m) use ($cv) {

                            $m->from($this->sender, get_current_company()->name)
                                ->replyTo($this->replyTo, get_current_company()->name)
                                ->to($cv->email)
                                ->subject('Feedback');
                        });
                }

            }


        }


    }
}

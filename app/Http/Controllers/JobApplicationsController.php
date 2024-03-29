<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Validation\Rule;
use PDF;
use Curl;
use File;
use App\User;
use Exception;
use Validator;
use App\Models\Cv;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\Order;
use App\Models\Interview;
use App\Models\OrderItem;
use App\Models\AtsProduct;
use App\Models\AtsRequest;
use App\Models\AtsService;
use App\Models\JobActivity;
use App\Models\TestRequest;
use App\Models\Transaction;
use Illuminate\Mail\Mailer;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Http\Response;
use App\Models\InterviewNotes;
use App\Models\JobApplication;
use Spatie\CalendarLinks\Link;
use App\Jobs\BulkRequestTestJob;
use App\Exports\ApplicantsExport;
use App\SearchEngine\SearchEngine;
use App\Models\InterviewNoteValues;
use App\Exports\InterviewNoteExport;
use App\Models\InterviewNoteOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\WorkflowStepWithEmailJob;
use App\Models\InterviewNoteTemplates;
use Illuminate\Support\Facades\Storage;
use App\Jobs\AddApplicantToExportInBits;
use Madnest\Madzipper\Facades\Madzipper;
use App\Jobs\SaveSeamlessTestingResultJob;
use App\Models\Message as CandidateMessage;
use App\Jobs\CommenceProcessingForApplicantsCV;
use SeamlessHR\SolrPackage\Facades\SolrPackage;
use App\Http\Requests\DownloadApplicantCvRequest;
use App\Jobs\CommenceProcessingForInterviewNotes;
use App\Imports\BulkImportOfApplicantsToWorkflowStage;
use App\Exceptions\DownloadApplicantsInterviewException;
use App\Jobs\CommenceProcessingForApplicantsSpreedsheet;
use App\Http\Requests\DownloadApplicantSpreedsheetRequest;




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
        'Lagos', 'Abia', 'Abuja',
        'Adamawa', 'Akwa Ibom', 'Anambra',
        'Bauchi', 'Bayelsa', 'Benue',
        'Borno', 'Cross river', 'Delta',
        'Edo', 'Ebonyi', 'Ekiti',
        'Enugu', 'Gombe', 'Imo',
        'Jigawa', 'Kaduna', 'Kano',
        'Katsina', 'Kebbi', 'Kogi',
        'Kwara', 'Niger', 'Ogun',
        'Ondo', 'Osun', 'Oyo',
        'Nassarawa', 'Plateau', 'Rivers',
        'Sokoto', 'Taraba', 'Yobe',
        'Zamfara'
    ];
    private $qualifications = [
        'MPhil / PhD', 'MBA / MSc', 'MBBS',
        'B.Sc', 'HND', 'OND',
        'N.C.E', 'Diploma', 'High School (S.S.C.E)',
        'Vocational', 'Others'
    ];

    protected $mailer;


    private $sender;

    private $replyTo;

    protected $searchEngine;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer, SearchEngine $searchEngine)
    {
        $this->middleware('auth', [
            'except' => [
                'saveTestResult',
                'downloadApplicantsInterviewFile'
            ]
        ]);
        $this->mailer = $mailer;

        if (Auth::check()) {
            $this->sender = (get_current_company()->slug != "" && get_current_company()->slug) ? get_current_company()->slug . '@seamlesshr.com' : getEnvData('COMPANY_EMAIL');
            $this->replyTo = (get_current_company()->email) ? get_current_company()->email : getEnvData('COMPANY_EMAIL');
        } else {
            $this->sender = getEnvData('COMPANY_EMAIL', null, request()->clientId);
            $this->replyTo = getEnvData('COMPANY_EMAIL', null, request()->clientId);
        }

        $this->searchEngine = $searchEngine;
    }

    public function assess($appl_id)
    {

        $appl = JobApplication::with('job.workflow.workflowSteps', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'assess';

        $requests = TestRequest::where('job_application_id', $appl_id)->with('product.provider')->get();


        return view('applicant.assess', compact('appl', 'nav_type', 'requests'));
    }

    public function activities($appl_id)
    {

        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'activities';
        return view('applicant.activities', compact('appl', 'nav_type'));
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
            ->get();


        return view('applicant.documents', compact('appl', 'nav_type', 'documents'));
    }

    public function notes($appl_id)
    {
        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);

        $nav_type = 'notes';

        $interview_note_categories = InterviewNoteValues::with(
            'interviewer',
            'interview_note_option'
        )->where(
            'job_application_id',
            $appl->id
        )->get()->groupBy('interview_note_option.interview_note_template.name');


        return view('applicant.notes', compact('appl', 'nav_type', 'interview_note_categories'));
    }


    public function interviews($appl_id)
    {
        $appl = JobApplication::with('job', 'cv')->find($appl_id);

        check_if_job_owner($appl->job->id);


        $interviews = Interview::where('job_application_id', $appl->id)->get();

        // dd($interviews);
        $nav_type = 'interviews';
        return view('applicant.interviews', compact('appl', 'nav_type', 'interviews'));
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
        if (isset($appl->job->id)) {
            check_if_job_owner($appl->job->id);
            $job_id = $appl->job->id;
            $nav_type = 'profile';

            $permissions = getUserPermissions();
            return view('applicant.profile', compact('appl', 'nav_type', 'permissions', 'job_id'));
        }
        return back()->with('error', 'Something went wrong, please try again');
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
        $message_content = '';
        $user = '';

        if ($request->hasFile('document_file')) {
            $file_name = (@$request->document_file->getClientOriginalName());
            $fi = @$request->file('document_file')->getClientOriginalExtension();
            $document_file = $request->application_id . '-' . time() . '-' . $file_name;

            $upload = $request->file('document_file')->move(
                getEnvData('fileupload'),
                $document_file
            );
        } else {
            $document_file = '';
        }

        $message = CandidateMessage::create([
            'job_application_id' => $request->application_id,
            'message' => $request->message,
            'attachment' => $document_file,
            'user_id' => Auth::user()->id,
            'title' => $request->document_title,
            'description' => $request->document_description
        ]);


        $candidate = JobApplication::find($request->application_id);
        $email_title = "Message on your job application " . $candidate->job->title;
        $email_message = $message->message;
        $application_id = $request->application_id;
        $link = route('candidate-messages', $request->application_id);

        Mail::send('emails.new.admin_send_message', compact('candidate', 'email_title', 'email_message', 'message_content', 'user', 'link'), function ($m) use ($candidate, $email_title) {
            $m->from(getEnvData('COMPANY_EMAIL'))->to($candidate->candidate->email)->subject($email_title);
        });

        return redirect()->route('applicant-messages', ['appl_id' => $application_id]);
    }

    public function viewApplicants(Request $request)
    {
        //Check if he  is the owner of the job
        check_if_job_owner($request->jobID);

        $job = Job::with([
            'form_fields',
            'applicants',
            'workflow.workflowSteps' => function ($q) {

                return $q->orderBy('order', 'asc');
            }
        ])->find($request->jobID);


        $active_tab = 'candidates';
        $status = '';
        $jobID = $request->jobID;
        $this->search_params['filter_query'] = @$request->filter_query;
        $this->search_params['start'] = $start = ($request->start) ? ($request->start * $this->search_params['row']) : 0;

        if (!$job) {
            return redirect()->route("dashboard")->withErrors(['error' => "Invalid Job Role Specified"]);
        }
        //If age is available
        if (@$request->age) {

            //2015-09-16T00:00:00Z
            $start_dob = explode(' ', Carbon::now()->subYears(@$request->age[0]))[0] . 'T23:59:59Z';
            $end_dob = explode(' ', Carbon::now()->subYears(@$request->age[1]))[0] . 'T00:00:00Z';

            $solr_age = [$start_dob, $end_dob];
        } else {
            $request->age = [getEnvData('AGE_START'), getEnvData('AGE_END')];
            $solr_age = null;
        }

        //If years of experience is available
        if (@$request->exp_years) {
            //2015-09-16T00:00:00Z
            $solr_exp_years = [@$request->exp_years[0], @$request->exp_years[1]];
        } else {
            $request->exp_years = [getEnvData('EXPERIENCE_START'), getEnvData('EXPERIENCE_END')];
            $solr_exp_years = null;
        }

        //If graduation grade  is available
        if (@$request->graduation_grade) {
            //2015-09-16T00:00:00Z
            $solr_graduation_grade = [@$request->graduation_grade[0], @$request->graduation_grade[1]];
        } else {

            $request->graduation_grade = [getEnvData('GRADUATION_GRADE_START'), getEnvData('GRADUATION_GRADE_START')];

            $solr_graduation_grade = null;
        }

        if (@$request->minimium_remuneration) {
            //2015-09-16T00:00:00Z
            $solr_minimium_remuneration = [@$request->minimium_remuneration[0], @$request->minimium_remuneration[1]];
        } else {
            $request->minimium_remuneration = [getEnvData('REMUNERATION_MINIMIUM'), getEnvData('REMUNERATION_MAXIMIUM')];
            $solr_minimium_remuneration = null;
        }

        if (@$request->maximium_remuneration) {
            //2015-09-16T00:00:00Z
            $solr_maximium_remuneration = [@$request->maximium_remuneration[0], @$request->maximium_remuneration[1]];
        } else {

            $request->maximium_remuneration = [getEnvData('REMUNERATION_MINIMIUM'), getEnvData('REMUNERATION_MAXIMIUM')];

            $solr_maximium_remuneration = null;
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
            $request->video_application_score = [
                getEnvData('VIDEO_APPLICATION_START'),
                getEnvData('VIDEO_APPLICATION_END')
            ];
            $solr_video_application_score = null;
        }


        $result = $this->searchEngine->get_applicants(
            $this->search_params,
            $request->jobID,
            @$request->status,
            @$request->clientId,
            @$solr_age,
            @$solr_exp_years,
            @$solr_video_application_score,
            @$solr_test_score,
            @$solr_graduation_grade,
            @$solr_minimium_remuneration,
            @$solr_maximium_remuneration,
        );

        $statuses = $job->workflow->workflowSteps()->pluck('slug');

        $application_statuses = get_application_statuses(
            $result['facet_counts']['facet_fields']['application_status'],
            $request->jobID,
            $statuses
        );


        if (isset($request->status)) {
            $status = $request->status;
            if ($request->status != "") {
                $application_statuses['ALL'] = $application_statuses[$status];
            }
        }
        $end = (($start + $this->search_params['row']) > intval($application_statuses['ALL'])) ? $application_statuses['ALL'] : ($start + $this->search_params['row']);
        $showing = view(
            'cv-sales.includes.top-summary', [
            'start' => ($start + 1),
            'end' => $end,
            'total' => $application_statuses['ALL'],
            'type' => $request->status,
            'page' => floor($request->start + 1),
            'filters' => $request->filter_query
        ])->render();
        $myJobs = Job::getMyJobs();
        $all_my_cvs = $this->searchEngine->get_all_my_cvs(
            $this->search_params,
            null,
            null
        )['response']['docs'];
        $myFolders = $all_my_cvs ? array_unique(array_pluck($all_my_cvs, 'cv_source')) : [];

        if (($key = array_search('Direct Application', $myFolders)) !== false) {
            unset($myFolders[$key]);
        }

        $states = $this->states;
        $qualifications = $this->qualifications;
        $grades = grades();
        $permissions = getUserPermissions();

        if ($request->ajax()) {

            $search_results = view(
                'job.board.includes.applicant-results-item',
                compact(
                    'job',
                    'active_tab',
                    'status',
                    'result',
                    'jobID',
                    'start',
                    'myJobs',
                    'myFolders',
                    'application_statuses',
                    'request',
                    'permissions'
                )
            )->render();
            $search_filters = view(
                'cv-sales.includes.search-filters', [
                'result' => $result,
                'search_query' => $request->search_query,
                'status' => $status,
                'age' => @$request->age,
                'exp_years' => @$request->exp_years,
                'job' => $job,
                'graduation_grade' => $request->graduation_grade,
                'minimium_remuneration' => $request->minimium_remuneration,
                'maximium_remuneration' => $request->maximium_remuneration,
                'video_application_score' => @$request->video_application_score,
                'test_score' => @$request->test_score
            ])->render();

            return response()->json([
                'search_results' => $search_results,
                'search_filters' => $search_filters,
                'showing' => $showing,
                'count' => $result['response']['numFound'],
                'status' => $request->status,
            ]);
        } else {

            $age = [getEnvData('AGE_START'), getEnvData('AGE_END')];
            $exp_years = [getEnvData('EXPERIENCE_START'), getEnvData('EXPERIENCE_END')];
            $graduation_grade = [getEnvData('GRADUATION_GRADE_START'), getEnvData('GRADUATION_GRADE_END')];
            $minimium_remuneration = [getEnvData('GRADUATION_GRADE_START'), getEnvData('GRADUATION_GRADE_END')];
            $maximium_remuneration = [getEnvData('GRADUATION_GRADE_START'), getEnvData('GRADUATION_GRADE_END')];
            $video_application_score = [getEnvData('VIDEO_APPLICATION_START'), getEnvData('VIDEO_APPLICATION_END')];

            $test_score = [40, 160];
            $check_both_permissions = checkForBothPermissions($jobID);
            $defaultView = true;
            return view(
                'job.board.candidates',
                compact(
                    'minimium_remuneration',
                    'maximium_remuneration',
                    'defaultView',
                    'graduation_grade',
                    'job',
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
                    'myFolders',
                    'application_statuses',
                    'job',
                    'video_application_score',
                    'request',
                    'states',
                    'qualifications',
                    'grades',
                    'permissions',
                    'check_both_permissions'
                )
            );
        }
    }


    public function uploadApplicantsToSolr()
    {
    }





    public function oneApplicantData(Request $request)
    {

        $applicants = JobApplication::with('job', 'cv')->find([68825, 68824, 68827]);

        foreach ($applicants as $applicant) {
            $cand['gender'] = $applicant->cv->gender;
            $cand['last_company_worked'] = $applicant->cv->last_company_worked;
            $cand['dob'] = $applicant->cv->date_of_birth;
            $cand['cv_file'] = $applicant->cv->cv_file;
            $cand['display_picture'] = $applicant->cv->display_picture;
            $cand['years_of_experience'] = $applicant->cv->years_of_experience;
            $cand['extracted_content'] = [0];
            $cand['rank'] = 1;
            $cand['id'] = $applicant->id;
            $cand['state'] = $applicant->cv->state;
            $cand['first_name'] = $applicant->cv->first_name;
            $cand['last_name'] = $applicant->cv->last_name;
            $cand['headline'] = [$applicant->cv->headline];
            $cand['last_modified'] = $applicant->cv->last_modified;
            $cand['grade'] = $applicant->cv->graduation_grade;
            $cand['willing_to_relocate'] = $applicant->cv->willing_to_relocate ? true : false;
            $cand['email'] = $applicant->cv->email;
            $cand['last_position'] = $applicant->cv->last_position;
            $cand['cv_source'] = $applicant->cv->cv_source;
            $cand['highest_qualification'] = $applicant->cv->highest_qualification;
            $cand['marital_status'] = $applicant->cv->marital_status;
            $cand['phone'] = $applicant->cv->phone;
            $cand['cover_note'] = $applicant->cover_note;
            $cand['job_id'] = [$applicant->job_id];
            $cand['application_date'] = $applicant->created;
            $cand['application_modified'] = $applicant->created;
            $cand['application_id'] = [$applicant->id];
            $cand['is_approved'] = true;
            $cand['application_status'] = [$applicant->status];
            $cand['job_title'] = [$applicant->job->title];

            $client_id = $applicant->candidate->client_id ?? null;
            $this->searchEngine->create_new_document($cand, $client_id);
        }
    }

    /**
     * Send Applicants spreedsheet
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function downloadApplicantSpreadsheet(Request $request)
    {

        set_time_limit(0);
        //Check if you should have access to the excel
        check_if_job_owner($request->jobId);

        $job = Job::find($request->jobId);
        $this->search_params['filter_query'] = @$request->filter_query;
        $this->search_params['row'] = 2147483647;


        //If age is available
        if (@$request->age) {
            $date = Carbon::now();
            $start_dob = explode(' ', $date->subYears(@$request->age[0]))[0] . 'T23:59:59Z';
            $end_dob = explode(' ', $date->subYears(@$request->age[1]))[0] . 'T00:00:00Z';
            $solr_age = [$start_dob, $end_dob];
        } else {
            $request->age = [15, 65];
            $solr_age = null;
        }


        //If years of experience is available
        if (@$request->exp_years) {
            $solr_exp_years = [@$request->exp_years[0], @$request->exp_years[1]];
        } else {
            $request->exp_years = [0, 40];
            $solr_exp_years = null;
        }

        //If test score is available
        if (@$request->test_score) {
            $solr_test_score = [@$request->test_score[0], @$request->test_score[1]];
        } else {
            $request->test_score = [40, 160];
            $solr_test_score = null;
        }

        //If video application score is available
        if (@$request->video_application_score) {
            $solr_video_application_score = [
                @$request->video_application_score[0],
                @$request->video_application_score[1]
            ];
        } else {
            $request->video_application_score = [
                getEnvData('VIDEO_APPLICATION_START'),
                getEnvData('VIDEO_APPLICATION_END')
            ];
            $solr_video_application_score = null;
        }


        $filename = str_replace(['/', '\'', ' ', ','], '', "Applicants Report - {$job->title} - {$job->id}.csv");

        // findOrMakeDirectory('exports');

        CommenceProcessingForApplicantsSpreedsheet::dispatch(
            get_current_company(),
            Auth::user(),
            $filename,
            $this->search_params,
            $request->jobId,
            @$request->status,
            @$solr_age,
            @$solr_exp_years,
            @$solr_video_application_score,
            @$solr_test_score,
            @$request->cv_ids
        )->onQueue('export');

        $link = asset("exports/{$filename}");
        return response()->json(
            [
            "status" => "success",
            "msg" => 'Export started, Please check your email in few minutes.'
            ]
        );
    }


    /**
     * Send Applicants Cv in zip format to admin mail
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function downloadApplicantCv(Request $request)
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
            $request->video_application_score = [
                getEnvData('VIDEO_APPLICATION_START'),
                getEnvData('VIDEO_APPLICATION_END')
            ];
            $solr_video_application_score = null;
        }
        $filename = Auth::user()->id . "_" . get_current_company()->id . "_" . time() . "_" . $job->id . ".zip";
        // findOrMakeDirectory('exports');

        CommenceProcessingForApplicantsCV::dispatch(
            get_current_company(),
            Auth::user(),
            $filename,
            $this->search_params,
            $request->jobId,
            @$request->status,
            @$solr_age,
            @$solr_exp_years,
            @$solr_video_application_score,
            @$solr_test_score,
            @$request->cv_ids
        );

        $link = asset("exports/{$filename}");
        return response()->json([
            "status" => "success",
            "msg" => 'Export started, Please check your email in few minutes.'
        ]);
    }

    /**
     * Send Applicants interview notes in zip format to admin mail
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */

    public function downloadInterviewNotes(Request $request)
    {
        $job = Job::with('applicants')->find($request->jobId);
        if (!$request->has('app_ids')) {
            $application_ids = JobApplication::where('job_id', $job->id)->pluck('id');
        } else {
            $application_ids = $request->app_ids;
        }
        if ($application_ids->count()) {
            $filename = "Bulk Interview Notes {$job->id}.zip";
            // findOrMakeDirectory('exports');
            $download_type = 'Interview Notes ZIP';
            CommenceProcessingForInterviewNotes::dispatch(get_current_company(), Auth::user(), $application_ids, $request->jobId, $filename, $download_type);

            $link = asset("exports/{$filename}");
            return response()->json([
                "status" => "success",
                "msg" => 'Export started, Please check your email in few minutes.'
            ]);
        }
        return response()->json(["status" => "error", "msg" => "Export could not start,plese try again"]);
    }


    /**
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */

    public function downloadInterviewNotesCSV(Request $request)
    {
        ini_set('memory_limit', '1024M');
        set_time_limit(0);

        $job = Job::with(['applicantsViaJAT' => function ($query) use ($request) {
            $query->whereStatus($request->status);
        }])->find($request->jobId);

        $application_ids = (!$request->has('app_ids')) ? $job->applicantsViaJAT->pluck('id') : $request->app_ids;

        $export_file = "interview-note-" . time() . "{$job->id}.csv";
        // findOrMakeDirectory('exports');
        $download_type = 'Interview Notes CSV';
        if (count($application_ids)) {
            CommenceProcessingForInterviewNotes::dispatch(get_current_company(), Auth::user(), $application_ids, $request->jobId, $export_file, $download_type);

            $link = asset("exports/{$export_file}");
            return response()->json([
                "status" => "success",
                "msg" => 'Export started, Please check your email in few minutes.'
            ]);
        }
        return response()->json(["status" => "error", "msg" => "Export could not start,plese try again"]);
    }

    public function downloadApplicantsInterviewFile(string $filename)
    {

        try {
            $decrypted_file_name = decrypt($filename);
            $file = \Storage::disk('Csv')->get($decrypted_file_name);

            return (new \Illuminate\Http\Response($file, 200))
                ->header('Content-Type', 'application/*')
                ->header('Cache-Control', 'public')
                ->header('Content-Description', 'File Transfer')
                ->header('Content-Disposition', 'attachment; filename=' . $decrypted_file_name);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'File not found');
        }

    }

    public function massAction(Request $request)
    {

        JobApplication::massAction($request->job_id, $request->cv_ids, $request->status, $request->step_id);


        //MAT: ignore the rejected part of the code for now
        switch ($request->status) {
            case 'ALL':

                break;

            default:
                break;
        }
        //check if the step has message
        $getStep = WorkflowStep::where('id', $request->step_id)->first();
        if (!is_null($getStep->message_template) && !empty($getStep->message_template)) {
            dispatch(new WorkflowstepWithEmailJob($request->cv_ids, $getStep->message_template, $request->job_id));
        }

        return save_activities($request->status, $request->job_id, $request->app_ids);
    }

    public function writeReview(Request $request)
    {
        return save_activities('REVIEW', $request->job_id, $request->app_ids, $request->comment);
    }

    public function getAllApplicantStatus(Request $request)
    {
        $job = Job::with(['form_fields', 'workflow.workflowSteps'])->find($request->job_id);
        $statuses = $job->workflow->workflowSteps()->pluck('slug');

        $application_statuses = get_application_statuses(
            [],
            $request->job_id,
            $statuses
        );


        return view('job.board.includes.applicant-status', compact('application_statuses', 'job'));
    }

    public function JobListData(Request $request)
    {
        $result = $this->searchEngine->get_applicants($this->search_params, $request->job_id, @$request->status, @$request->clientId);
        $application_statuses = get_application_statuses(
            $result['facet_counts']['facet_fields']['application_status'],
            $request->job_id,
            $statuses = $request->workflow_steps
        );

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


        echo $stats;
    }

    public function getJobsData(Request $request)
    {
        $jobs_data = [];

        if ($request->input('jobs_ids') <> null && is_array($request->input('jobs_ids'))) {
            $jobs_ids = $request->input('jobs_ids');
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

                $result = $this->searchEngine->get_applicants(
                    $this->search_params,
                    $job_id,
                    '',
                    $request->clientId
                ); // status parater value is formerly : @$request->status
                $application_statuses = isset($result['facet_counts']) ? get_application_statuses(
                    $result['facet_counts']['facet_fields']['application_status'],
                    $job_id,
                    $statuses = $job->workflow->workflowSteps()->pluck('slug')
                ) : [];

                foreach ($application_statuses as $key => $value) {
                    $job_response_data['html_data'] .= '<div class="job-item">'
                        . '<span class="number">' . $value . '</span>'
                        . '<br/>'
                        . $key
                        . '</div>';
                }

                $jobs_data[] = $job_response_data;
            }

            return response()->json($jobs_data);
        }
    }



    public function getOneJobsData(Request $request)
    {
        $jobs_data = [];

        $job_id = $request->jobs_ids;

        $job_response_data = [
            'id' => $job_id,
            'html_data' => ''
        ];

        $job = Job::with([
            'workflow.workflowSteps' => function ($q) {
                return $q->orderBy('order', 'asc');
            }
        ])->find($job_id);

        $result = $this->searchEngine->get_applicants(
            $this->search_params,
            $job_id,
            '',
            $request->clientId
        ); // status parater value is formerly : @$request->status


        $application_statuses = isset($result['facet_counts']) ? get_application_statuses(
            $result['facet_counts']['facet_fields']['application_status'],
            $job_id,
            $statuses = $job->workflow->workflowSteps()->pluck('slug')
        ) : [];


        foreach ($application_statuses as $key => $value) {
            $job_response_data['html_data'] .= '<div class="job-item">'
                . '<span class="number">' . $value . '</span>'
                . '<br/>'
                . $key
                . '</div>';
        }

        $jobs_data[] = $job_response_data;

        return response()->json($jobs_data);
    }


    public function JobViewData(Request $request)
    {

        $result = $this->searchEngine->get_applicants($this->search_params, $request->job_id, @$request->status, $request->clientId);
        $solr_total_applicants = ($result['response']['numFound']);
        $matching = 10000;

        $job = Job::with("applicants")->find($request->job_id);
        $db_total_applicants = $job->applicants->count();

        $now = time(); // or your date as well
        $your_date = strtotime($job->post_date);
        $datediff = $now - $your_date;
        $open_days = floor($datediff / (60 * 60 * 24));

        $amount_spent = 0;

        $stats = '<table class="table table-bordered">
                            <tbody>
                        <tr>
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="' . route(
            'job-candidates',
            [$job->id]
        ) . ' ">' . ($solr_total_applicants ?: 0) . '</a></h1><small class="hidden">' . $db_total_applicants . '</small><small class="text-muted">Applicants</small></td>
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
        $comments = JobActivity::with('user', 'application.cv', 'job')->where(
            'activity_type',
            'REVIEW'
        )->where('job_application_id', $appl->id)->get();
        $notes = InterviewNotes::with('user')->where('job_application_id', $appl->id)->get();

        return view(
            'modals.dossier',
            compact('applicant_badge', 'app_ids', 'cv_ids', 'jobID', 'appl', 'comments', 'notes')
        );
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
        $show_other_sections = true;

        $jobID = $appl->job->id;
        check_if_job_owner($jobID);
        $comments = JobActivity::with('user', 'application.cv', 'job')->where(
            'activity_type',
            'REVIEW'
        )->where('job_application_id', $appl->id)->get();
        $notes = InterviewNotes::with('user')->where('job_application_id', $appl->id)->get();
        $interview_notes = InterviewNoteValues::with(
            'interviewer',
            'interview_note_option'
        )->where('job_application_id', $appl->id)->get()->groupBy('interviewed_by');


        $path = public_path('uploads/tmp/');

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view(
            'modals.inc.dossier-content',
            compact('applicant_badge', 'app_ids', 'cv_ids', 'jobID', 'show_other_sections', 'appl', 'comments', 'interview_notes')
        )->render());


        return view(
            'modals.inc.dossier-content',
            compact('applicant_badge', 'app_ids', 'cv_ids', 'show_other_sections', 'jobID', 'appl', 'comments', 'interview_notes')
        )->render();

        $pdf->save($path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' dossier.pdf', true);


        $filename = $appl->cv->first_name . ' ' . $appl->cv->last_name . ".zip";
        $filename = str_replace('/', '', $filename);
        $filename = str_replace('\'', '', $filename);
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


        $test_path = getEnvData('SEAMLESS_TESTING_APP_URL', env('SEAMLESS_TESTING_APP_URL')). "/test/combined/pdf/" . $appl->id;
        $test_local_file = $path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' tests.pdf';


        if (@copy($test_path, $test_local_file)) {
            //if test exists
            if ($test_local_file) {
                $files_to_archive[] = $test_local_file;
            }
        }
        $timestamp = " " . time() . " ";

        $zipPath = $path . $filename;

        Madzipper::make($zipPath)->add($files_to_archive)->close();

        return Response::download(
            $zipPath,
            $filename,
            ['Content-Type' => 'application/octet-stream']
        );
    }

    /**
     * [modalInterview modal for interview scheduling]
     * @param  Request $request
     * @return View
     */
    public function modalInterview(Request $request)
    {
        $modalVars = $this->modalActions('Interview', $request->cv_id, $request->app_id);
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        if (count($app_ids) > 1) {
            foreach ($app_ids as $key => $application_id) {
                $job_application = JobApplication::find($application_id);
                $applicant_step = $job_application->job->workflow->workflowSteps->where('slug', $job_application->status)->first();
                if ($applicant_step->type != 'interview') {
                    $interview_step_error = $job_application->cv->first_name . " is not on an interview step, pls untick";
                    return view('modals.interview-error', compact('interview_step_error'));
                }
                $step = $applicant_step->slug;
                $stepId = $applicant_step->id;
            }
        } else {
            $step = $request->stepSlug;
            $stepId = $request->stepId;
        }

        /**
         * [$interviewers get all admins with this permission]
         * @var collection
         */
        $interviewers = User::whereHas('workflow_steps', function ($query) use ($stepId) {
            $query->where('workflow_step_id', $stepId);
        })->pluck('name', 'id');


        /**
         * [$is_a_reschedule: is this interview a reschedule]
         * @var boolean
         */
        $is_a_reschedule = false;
        $interview_record = Interview::whereIn('job_application_id', $app_ids)->get()->last();
        if ($interview_record != null) {
            $is_a_reschedule = true;
        }
        $interview_notes = InterviewNoteTemplates::where('company_id', get_current_company()->id)->orderBy('name')->get();
        return view('modals.interview', compact('applicant_badge', 'app_ids', 'cv_ids', 'appl', 'step', 'stepId', 'interviewers', 'is_a_reschedule', 'interview_record', 'interview_notes'));
    }

    public function modalInterviewNotes(Request $request)
    {

        $app_id = @$request->app_id;
        $cv_id = @$request->cv_id;
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        $applicant_badge = @$this->getApplicantBadge($appl->cv);

        $notes = InterviewNotes::where('job_application_id', $app_id)->where(
            'interviewer_id',
            @Auth::user()->id
        )->get();

        $note = InterviewNotes::where('job_application_id', $app_id)->where(
            'id',
            @$request->interview_id
        )->get()->first();


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

            $this->searchEngine->update_core();

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

        if (count($cv_ids) > 0 && count($app_ids) > 1) {
            $applicant_badge = @$this->getMultipleApplicantBadge($action, count($app_ids));
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
        if ($request->has("operation") && ($request->query("operation") == 'bulk_send_assessment_link')) {
            $job = Job::with([
                'form_fields', 'applicants', 'workflow.workflowSteps' => function ($q) {
                    return $q->orderBy('order', 'asc');
                }
            ])->find($request->query("jobID"));
            $assessments_workflows = $job->workflow->workflowSteps->filter(function ($q) {
                return $q->type == "assessment";
            })->pluck("slug")->toArray();
            $workflow_step = $request->status;
            if (in_array(strtoupper($workflow_step), $assessments_workflows)) {
                $application_ids = JobApplication::where("job_id", $request->query("jobID"))->where("status", $workflow_step)->pluck("id")->toArray();
                $modalVars = $this->modalActions("Current Step [$workflow_step] with", $request->cv_id, implode(",", $application_ids));
            } else {
                return response()->json(["status" => "error", "errors" => ["Current Workflow Step[$workflow_step] Is not an Assessment Type"]], 422);
            }
        } else {
            $modalVars = $this->modalActions('Test', $request->cv_id, $request->app_id);
        }
        if (is_array($modalVars)) {
            extract($modalVars);
        } else {
            return $modalVars;
        }

        $test_available = true;
        $count = count($cv_ids);
        $products = get_current_company()->tests;
        $section = 'TEST';
        $type = "TEST";
        $done_test = array_pluck(TestRequest::whereIn('job_application_id', $app_ids)->get()->toArray(), 'id');

        $step = $request->stepSlug;
        $stepId = $request->stepId;

        return view(
            'modals.assess',
            compact(
                'applicant_badge',
                'app_ids',
                'cv_ids',
                'products',
                'appl',
                'test_available',
                'section',
                'count',
                'type',
                'step',
                'stepId'
            )
        );
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

        return view(
            'modals.assess',
            compact(
                'applicant_badge',
                'app_ids',
                'cv_ids',
                'products',
                'appl',
                'count',
                'section',
                'type',
                'step',
                'stepId'
            )
        );
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

        return view(
            'modals.assess',
            compact(
                'applicant_badge',
                'app_ids',
                'cv_ids',
                'products',
                'appl',
                'count',
                'section',
                'type',
                'step',
                'stepId'
            )
        );
    }


    public function requestTest(Request $request)
    {

        $comp_id = get_current_company()->id;
        $invoice_no = '#' . mt_rand();

        $test_ids = [];


        $order = Order::firstOrCreate([
            'company_id' => $comp_id,
            'order_date' => date('Y-m-d H:i:s'),
            'total_amount' => (double) $request->total_amount,
            'invoice_no' => $invoice_no,
            'type' => $request->type

        ]);

        $transaction = Transaction::firstOrCreate([
            'order_id' => $order->id,
            'status' => 'false',
            'message' => 'Transaction Not Found'
        ]);



        foreach ($request->tests as $key => $test) {

            info('commenced bulk test request');
            BulkRequestTestJob::dispatch($key, $test, $order, $request->all(), get_current_company());
            info('completed job');
        }


        $res = [];
        //TODO: Though $test_ids is no longer in use at the front end, it
        // needs to be extracted from job and be made available in return response whenever it is to be used in future
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
                return back()->with('error', ($validator->messages()));
            } else {
                SaveSeamlessTestingResultJob::dispatch($request->all());
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
        }
        $res = [];
        $res = ['total_amount' => $request->total_amount, 'order_id' => $order->id, 'type_ids' => $check_ids];
        return $res;
        // JobApplication::massAction( @$request->job_id, [ @$request->cv_id ], 'ASSESSED' );
    }


    public function Checkout(Request $request)
    {
    }

    public function inviteForInterview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required',
            'date' => 'required',
            'message' => 'required',
            'duration' => 'required',
            'interviewer_id' => 'required',
            'interview_template_ids' => 'required',
        ], [
            'interview_template_id.required' => 'Interview notes must be attached'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
        }

        $appls = JobApplication::with('cv', 'job', 'job.company')->whereIn('id', $request->app_ids)->get();

        foreach ($appls as $key => $appl) {

            $cv = $appl->cv;
            $job = $appl->job;

            if ($request->file('interview_file')) {
                $destination = 'uploads';
                $extension = $request->file('interview_file')->getClientOriginalExtension();
                $file_name = rand(1111111, 9999999) . '.' . $extension;
                $request->file('interview_file')->move($destination, $file_name);
            } else {
                $file_name = null;
            }

            $date = date("Y-m-d H:i", strtotime($request->date));

            $data = [
                'location' => @$request->location,
                'message' => @$request->message,
                'date' => $date,
                'job_application_id' => $appl->id,
                'duration' => $request->duration,
                'interview_file' => $file_name,
                'reschedule' => ($request->reschedule == 'true') ? 1 : 0,
            ];

            $interview = Interview::create($data);

            //attach interview notes to interview
            $interviewer_template_ids = explode(",", $request->interview_template_ids[0]);
            $interview->templates()->attach($interviewer_template_ids);

            // attach interviewers to interview
            $interviewer_ids = explode(",", $request->interviewer_id[0]);

            $interview->users()->attach($interviewer_ids);
            $duration = (int)$request->duration;

            $from = date('Y-m-d H:i', strtotime($request->date));
            $to =  date('Y-m-d H:i', strtotime("+$duration minutes", strtotime($request->date)));

            $from_in_carbon_format = Carbon::createFromFormat('Y-m-d H:i', $from);
            $to_in_carbon_format = Carbon::createFromFormat('Y-m-d H:i', $to);

            $link = Link::create('Interview Schedule', $from_in_carbon_format, $to_in_carbon_format)
                ->description($request->message)
                ->address($request->location);


            // Generate a data uri for an ics file (for iCal & Outlook)
            $invite = $link->ics();

            if ($appl->job->company->id == 96) {
                Mail::send(
                    'emails.new.interview_invitation_ibfc',
                    ['cv' => $cv, 'job' => $job, 'companyDetails' => $appl->job->company, 'interview' => (object)$data],
                    function (Message $m) use ($cv) {
                        $m->from(getEnvData('COMPANY_EMAIL'))->to($cv->email)->subject('Interview Invitation');
                    }
                );
            } else {
                Mail::send(
                    'emails.new.interview_invitation',
                    ['cv' => $cv, 'job' => $job, 'companyDetails' => $appl->job->company, 'interview' => (object)$data],
                    function (Message $m) use ($cv, $invite) {
                        $m->from($this->sender, get_current_company()->name)
                            ->replyTo($this->replyTo, get_current_company()->name)
                            ->to($cv->email)
                            ->subject('Interview Invitation')
                            ->attach($invite, [
                                'as'  => 'interview.ics',
                                'mime' => 'text/calendar;charset=UTF-8;method=REQUEST'
                            ]);
                    }
                );
            }

            foreach ($interviewer_ids as $key => $interviewer_id) {

                $interviewer = User::find($interviewer_id);
                //send mail to interviewer
                Mail::send(
                    'emails.new.interviewer',
                    ['cv' => $cv, 'job' => $job, 'companyDetails' => $appl->job->company,  'interviewer' => $interviewer, 'interview' => (object)$data],
                    function (Message $m) use ($cv, $interviewer) {
                        $m->from($this->sender, get_current_company()->name)
                            ->replyTo($this->replyTo, get_current_company()->name)
                            ->to($interviewer->email)
                            ->subject('Invitation to oversee Interview');
                    }
                );
            }
        }


        save_activities('INTERVIEWED', $request->job_id, $request->app_ids);

        JobApplication::massAction(@$request->job_id, @$request->cv_ids, $request->step, $request->stepId);
    }

    public function previewInterview(Request $request)
    {
        $appls = JobApplication::with('cv', 'job', 'job.company')->whereIn('id', $request->app_ids)->get();
        foreach ($appls as $key => $appl) {
            $cv = $appl->cv;
            $job = $appl->job;
            if ($request->file('interview_file')) {
                $destination = 'uploads';
                $extension = $request->file('interview_file')->getClientOriginalExtension();
                $file_name = rand(1111111, 9999999) . '.' . $extension;
                $request->file('interview_file')->move($destination, $file_name);
            } else {
                $file_name = null;
            }
            $date = date('D, j-n-Y, h:i A', strtotime($request->date));
            $data = [
                'location' => $request->location,
                'message' => $request->message,
                'date' => $date,
                'job_application_id' => $appl->id,
                'duration' => $request->duration,
                'interview_file' => $file_name,
                'reschedule' => ($request->reschedule == 'true') ? 1 : 0,
            ];
            $duration = (int) $request->duration;
            $from = date('Y-m-d H:i', strtotime($request->date));
            $to =  date('Y-m-d H:i', strtotime("+$duration minutes", strtotime($request->date)));
            $from_in_carbon_format = Carbon::createFromFormat('Y-m-d H:i', $from);
            $to_in_carbon_format = Carbon::createFromFormat('Y-m-d H:i', $to);

            $interview = (object) $data;


            $invite_email = view('emails.new.interview_invitation', compact('cv', 'job', 'interview'))->render();

            $interviewer['name'] = "{Interviewer Name}";
            $interviewer = (object) $interviewer;
	        $companyDetails = $appl->job->company;

            $interviewer_email = view('emails.new.interviewer', compact('cv', 'job', 'companyDetails', 'interview', 'interviewer'))->render();
            return view('admin.preview', compact('invite_email', 'interviewer_email'));
        }
    }

    public function saveInterviewNote(Request $request)
    {

        $data = array_merge(@$request->texts, ((array)json_decode(@$request->radios)));

        $data['interview_date'] = Carbon::now();
        InterviewNotes::create($data);
    }

    public function viewInterviewNoteTemplates(Request $request)
    {

        $interview_note_templates = InterviewNoteTemplates::with('options')->where(
            'company_id',
            get_current_company()->id
        )->orderBy('name', 'asc')->get();

        return view('job.interview-note-templates', compact('interview_note_templates'));
    }

    public function editInterviewNoteTemplate(Request $request, InterviewNoteTemplates $id)
    {

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => ['required', validateInterviewNoteByCompany($request->id)],
            ], [
                'name.unique' => "Template already exist, Try creating template with another name"
            ]);

            InterviewNoteTemplates::where('id', $request->id)->where('company_id', get_current_company()->id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return redirect()->route("interview-note-templates")->with(["success" => 'Templated Updated Succesfully']);
        }

        $interview_note_template = InterviewNoteTemplates::where('id', $request->id)->where(
            'company_id',
            get_current_company()->id
        )->first();

        return view('job.interview-note-template-edit', compact('interview_note_template'));
    }


    public function createInterviewNoteTemplate(Request $request)
    {
        $interview_note_option = NULL;

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => ['required', validateInterviewNoteByCompany('NULL')],
            ], [
                'name.unique' => "Template already exist, Try creating template with another name"
            ]);

            InterviewNoteTemplates::create([
                'name' => $request->name,
                'description' => $request->description,
                'company_id' => get_current_company()->id
            ]);
            $createInterviewNotes = "Successfully Created Interview Notes Template(Admin)";
            mixPanelRecord($createInterviewNotes, auth()->user());
            return redirect()->route("interview-note-templates")->with(["success" => 'New Template has been created']);
        }

        $createInterviewNotes = "Initiated Create Interview Notes Template (Admin)";
        mixPanelRecord($createInterviewNotes, auth()->user());
        return view('job.interview-note-template-create', compact('interview_note_option'));
    }

    public function viewInterviewNoteOptions(Request $request)
    {
        $interview_template = InterviewNoteTemplates::where('id', $request->interview_template_id)->where(
            'company_id',
            get_current_company()->id
        )->first();

        $interview_note_options = InterviewNoteOptions::where(
            'company_id',
            get_current_company()->id
        )->where('interview_template_id', $request->interview_template_id)->orderBy('sort_order', 'ASC')->get();

        $interview_template_id = $request->interview_template_id;
        return view(
            'job.interview-note-options',
            compact('interview_note_options', 'interview_template_id', 'interview_template')
        );
    }


    public function duplicateInterviewNoteTemplate(Request $request, int $id)
    {
        if ($id) {
            $interview_template = InterviewNoteTemplates::where('id', $id)->where('company_id', get_current_company()->id)->first();
            $interview_template_duplicate = $interview_template->duplicate();
            if ($interview_template_duplicate) {
                return redirect()->back()->with(["success" => "$interview_template->name template  duplicated successfully"]);
            }
        }
        return redirect()->back()->with(["danger" => "Operation duplicate $interview_template->name template  unsuccessful"]);
    }

    function deleteInterviewNoteTemplate(Request $request)
    {
        $data = [
            "interview_note_template_id" => "required"
        ];
        $data = $request->validate($data);
        $interview_template = InterviewNoteTemplates::where('id', $data["interview_note_template_id"])->where('company_id', get_current_company()->id)->first();
        if ($interview_template) {
            $deleted = $interview_template->delete();
            if ($deleted)
                return redirect()->back()->with(["success" => "$interview_template->name template  deleted successfully"]);
        }
        return redirect()->back()->with(["danger" => "Operation delete $interview_template->name template  unsuccessful"]);
    }

    public function editInterviewNoteOptions(Request $request)
    {
        $interview_template = InterviewNoteTemplates::where(
            'id',
            $request->interview_template_id
        )->where('company_id', get_current_company()->id)->first();
        $interview_template_id = $request->interview_template_id;
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'type' => 'required'
            ]);

            if ((count($request->weight) > 0) && ($request->weight[0] > $request->weight[1])) {
                return redirect()->back()->with(["error" => "weight min must be less than weight max"]);
            }

            $check = !is_null($request->check[0]) ? json_encode($request->check) : null;
            $drop = !is_null($request->drop[0]) ? json_encode($request->drop) : null;

            InterviewNoteOptions::where('id', $request->id)->where('company_id', get_current_company()->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'weight_min' => $request->weight[0],
                'weight_max' => $request->weight[1],
                'check_box' => $check,
                'dropdown' => $drop
            ]);

            return redirect()->route("interview-note-options", ["interview_template_id" => $interview_template->id])
                ->with(["success" => "Updated Successfully"]);
        }

        $interview_note_option = InterviewNoteOptions::where('id', $request->id)->where(
            'company_id',
            get_current_company()->id
        )->first();

        return view(
            'job.interview-note-option-edit',
            compact('interview_note_option', 'interview_template_id', 'interview_template')
        );
    }


    public function createInterviewNoteOptions(Request $request)
    {
        // $interview_note_options = InterviewNoteOptions::where('company_id',get_current_company()->id )->get();

        $interview_template = InterviewNoteTemplates::where(
            'id',
            $request->interview_template_id
        )->where('company_id', get_current_company()->id)->first();
        $interview_template_id = $request->interview_template_id;

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'type' => 'required'
            ]);

            if ((count($request->weight) > 0) && ($request->weight[0] > $request->weight[1])) {
                return redirect()->back()->with(["error" => "weight min must be less than weight max"]);
            }
            $check_box = !is_null($request->check[0]) ? json_encode($request->check) : null;
            $drop = !is_null($request->drop[0]) ? json_encode($request->drop) : null;

            InterviewNoteOptions::create([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'weight_min' => $request->weight[0],
                'weight_max' => $request->weight[1],
                'company_id' => get_current_company()->id,
                'interview_template_id' => $request->interview_template_id,
                'check_box' => $check_box,
                'dropdown' => $drop
            ]);

            return redirect()->route("interview-note-options", ["interview_template_id" => $interview_template->id])
                ->with(["success" => "Created Successfully"]);
        }


        return view(
            'job.interview-note-option-create',
            compact('interview_template_id', 'interview_template')
        );
    }


    public function getMultipleApplicantBadge($action, $count)
    {
        return '<div class="row" >
      <div class="col-xs-12">
          <h5 class="text-center text-info text-brandon">' . $action . ' (' . $count . ') applicants?</h5>
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

        $interview_note = NULL;
        if (@$request->readonly) {
            $readonly = true;
            $interview_note = InterviewNoteValues::with('interviewer')->where(
                'job_application_id',
                $appl->id
            )->where('interviewed_by', $request->interviewed_by)->get()->pluck(
                'value',
                'interview_note_option_id'
            );
        } else {
            $readonly = false;
        }

        if ($request->isMethod('post')) {
            $data = array_merge(json_decode($request->radios, true), json_decode($request->texts, true), json_decode($request->checks, true), json_decode($request->drop, true));

            $interview_note_values = [];
            $score = 0;
            $correct_count = 0;

            foreach ($interview_note_options as $key => $option) {
                $rating = @isset($data['option_' . $option->id]) ? $data['option_' . $option->id] : null;
                $interview_note_values[] = [
                    'interview_note_option_id' => $option->id,
                    'value' => (@isset($data['option_check_' . $option->id]) ? $data['option_check_' . $option->id] : (($option->type == 'rating') && (($option->weight_min <= $rating) && ($rating >= $option->weight_min)) ||  (!empty($data['option_' . $option->id])) ?  $data['option_' . $option->id]  : assert(false, "Text or Rating Field Cannot Be null"))),
                    'job_application_id' => $appl->id,
                    'interviewed_by' => @Auth::user()->id,
                    'created_at' => Carbon::now(),
                ];
            }
            InterviewNoteValues::insert($interview_note_values);
        }

        return view(
            'modals.interview-notes',
            compact(
                'applicant_badge',
                'app_id',
                'cv_id',
                'appl',
                'interview_note_options',
                'interview_note',
                'interview_template_id',
                'readonly'
            )
        );
    }


    private function getInterviewNoteOption($jobID, $interview_template_id)
    {

        $interview_note_options = InterviewNoteOptions::where(
            'company_id',
            get_current_company()->id
        )->where('interview_template_id', $interview_template_id)->get();

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

        if ($step->message_to_applicant) {
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
                if (!is_null($cv->email)) {
                    Mail::send('emails.new.step_moved', ['cv' => $cv, 'job' => $job, 'step' => $step, 'message_content' => $message_content], function (Message $m) use ($cv, $job) {
                        $m->from($this->sender, get_current_company()->name)
                            ->replyTo($this->replyTo, get_current_company()->name)
                            ->to($cv->email)
                            ->subject('Feedback on Your Application for the role of ' . $job->title);
                    });
                }
            }
        }
    }

    public function deleteInterviewNoteOptions(Request $request)
    {
        $data = [
            "interview_note_option_id" => "required"
        ];
        $data = $request->validate($data);
        $interview_note_option = InterviewNoteOptions::where('id', $data["interview_note_option_id"])->where('company_id', get_current_company()->id)->first();
        if ($interview_note_option) {
            $deleted = $interview_note_option->delete();
            if ($deleted)
                return redirect()->back()->with(["success" => "$interview_note_option->name template  deleted successfully"]);
        }
        return redirect()->back()->with(["danger" => "Operation delete $interview_note_option->name template  unsuccessful"]);
    }

    public function sortInterviewNoteOptions()
    {

        $id_array = request()->ids;
        $sorting = 1;

        foreach ($id_array as $id) {
            $add = InterviewNoteOptions::where('id', '=', $id)->first();
            $add->sort_order = $sorting;
            $add->save();
            $sorting++;
        }
        return response()->json([
            'status' => true,
            'message' => "reordered successfully"
        ]);
    }
}

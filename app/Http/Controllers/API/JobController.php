<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Models\Cv;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\Role;
use GuzzleHttp\Client;
use App\Libraries\Solr;
use App\Models\Company;
use App\Models\Message;
use App\Models\JobBoard;
use App\Models\Workflow;
use App\Models\Candidate;
use App\Models\FormFields;
use App\Models\PrivateJob;
use App\Models\JobActivity;
use Illuminate\Mail\Mailer;
use Illuminate\Http\Request;
use App\Jobs\UploadApplicant;
use App\Models\InterviewNotes;
use App\Models\JobApplication;
use App\Models\Specialization;
use App\Models\FormFieldValues;
use App\Models\InterviewNoteValues;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\InterviewNoteOptions;
use Illuminate\Support\Facades\File;
use App\Jobs\JobApplicationSuccessful;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Validator;
use SeamlessHR\SolrPackage\Facades\SolrPackage;

class JobController extends Controller
{
    private $search_params = [
        'q' => '*',
        'row' => 20,
        'start' => 0,
        'default_op' => 'AND',
        'search_field' => 'text',
        'show_expired' => false,
        'sort' => 'application_date+desc',
        'grouped' => false,
    ];

    protected $mailer;

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
        'Zamfara',
    ];

    /**
     * Create a new controller instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {

        $this->qualifications = [

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
            'Others',

        ];

        $this->mailer = $mailer;


    }

    private function _confirmIntegrity($api_key)
    {
        if (!$company = Company::whereApiKey($api_key)->first()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Unauthorized!.',
                    'data' => [],
                ],
                401
            );
        }
    }


    public function listCompanies(Request $request)
    {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
// add any additional headers you need to support here
        header(
            'Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With,X-Auth-Token, X-API-KEY, X-CSRF-TOKEN, Origin'
        );
        //validate request via company api_key
        if (!$req_header = $request->header('X-API-KEY')) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Bad Request, make sure your request format is correct',
                    'data' => [],
                ],
                400
            );
        }

        return response()->json(
            [
                'status' => true,
                'message' => 'success',
                'data' => Company::get(),
            ]
        );

    }

    /**
     * TODO: This code so need to be refactored in the future
     *
     * @param Request $request
     * @param string $jobType
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function company(Request $request, $jobType = 'all', $company_id = NULL)
    {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        // add any additional headers you need to support here
        header(
            'Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With,X-Auth-Token, X-API-KEY, X-CSRF-TOKEN, Origin'
        );

        if (!$req_header = $request->header('X-API-KEY')) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Bad Request, make sure your request format is correct',
                    'data' => [],
                ],
                400
            );
        }

        // Get company and its jobs
        $company = Company::with(
            [
                'jobs' => function ($query) use ($jobType, $request) {
                    $query
                    ->with(['workflow.workflowSteps'=>function($sort){
                        $sort->orderBy('order', 'asc');
                    }])
                        ->whereStatus("ACTIVE")
                        ->when($request->with_expiry, function($q){
                            return $q->where('expiry_date','>=',Carbon::now()->toDateString());
                        })
                        ->orderBy('created_at', 'desc');
                    if ($jobType != 'all') {
                        $query->whereIsFor($jobType); // default $jobType == external
                    }
                }
                ,
                'jobs.form_fields',
                'jobs.specializations',
                'jobs.company',
            ]
        )->when($request->hrms_id, function($q) use($request){
            return $q->where('hrms_id', $request->hrms_id);
        });

        if (is_null($company_id))
            $company = $company->first();
        else
            $company = $company->find($company_id);

        if (!$company) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Company doesn\'t exist. Please check request again.',
                    'data' => [],
                ],
                401
            );
        }

        if ($company->logo) {
            $company->logo = get_company_logo(@$company->logo);
        }

        return response()->json(
            [
                'status' => true,
                'message' => 'success',
                'data' => $company,
            ]
        );

    }

    public function applicants(Request $request, $job_id, $status_slug)
    {
        //validate request via company api_key
        if (!$req_header = $request->header('X-API-KEY')) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Bad Request, make sure your request format is correct',
                    'data' => [],
                ],
                400
            );
        }

        if (!$company = Company::whereApiKey($req_header)->first()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Unauthorized!.',
                    'data' => [],
                ],
                401
            );
        }

        $status_slug = strtoupper($status_slug);
        
        $applicants = Job::with(
            [
                'applicantsViaJAT' => function ($q) use ($status_slug) { 
                    // applicant via JAT, JAT - Job Applications Table
                    if ($status_slug != 'ALL') {
                        $q->whereStatus($status_slug);
                    }
                    $q->with('cv');
                },
            ]
        )->find($job_id)->applicantsViaJAT;


        foreach ($applicants as $key => $applicant) {
            // code...
            if ($applicant->cv) {
                $cv_path = public_path('uploads/CVs');
                findOrMakeDirectory($cv_path);
                $path_to_file = $cv_path . '/' . $applicant->cv->cv_file;

                $arrContextOptions = array("ssl" => array("verify_peer" => false, "verify_peer_name" => false));
                $file_content = base64_encode(file_get_contents($path_to_file, false, stream_context_create($arrContextOptions)));
                $applicant->cv->file_content = $file_content;

                // interview notes

                $comments = JobActivity::with('user', 'application.cv', 'job')->where('activity_type',
                    'REVIEW')->where('job_application_id', $applicant->id)->get();
                $notes = InterviewNotes::with('user')->where('job_application_id', $applicant->id)->get();
                $interview_notes = InterviewNoteValues::with('interviewer',
                    'interview_note_option')->where('job_application_id', $applicant->id)->get()->groupBy('interviewed_by');

                $path = public_path('uploads/tmp/');
                findOrMakeDirectory($path);
                $show_other_sections = false;

                $appl = $applicant;
                // $pdf = App::make('snappy.pdf.wrapper');
                $jobID = $appl->job->id;

                $pdf = App::make('dompdf.wrapper');
                $pdf->loadHTML(view('modals.inc.dossier-content',
                    compact('jobID', 'appl', 'comments', 'interview_notes', 'show_other_sections'))->render());

                $pdf->save($path . $applicant->cv->first_name . '_' . $applicant->cv->last_name . '_interview.pdf', true);

                $path_to_interview_note = $path . '/' . $applicant->cv->first_name . '_' . $applicant->cv->last_name . '_interview.pdf';

                $interview_note_file_content = base64_encode(file_get_contents($path_to_interview_note, false, stream_context_create($arrContextOptions)));

                $applicant->cv->interview_note_file_name = $applicant->cv->first_name . '_' . $applicant->cv->last_name . '_interview.pdf';
                $applicant->cv->interview_note_file = $interview_note_file_content;

                // other docs
                $message_docs = Message::where('job_application_id', $applicant->id)
                    ->where('user_id', null)
                    ->get();

                $message_docs_file = [];

                foreach ($message_docs as $key => $doc) {
                    if ($doc->attachment) {

                        $path_to_doc = public_path('uploads') . '/' . $doc->attachment;
                        $doc_file_content = base64_encode(file_get_contents($path_to_doc, false, stream_context_create($arrContextOptions)));
                        $applicant->cv->file_content = $file_content;

                        $doc_array = ['title' => $doc->title, 'attachment' => $doc->attachment, 'content' => $doc_file_content];

                        array_push($message_docs_file, $doc_array);

                    }
                }

                $applicant->document = $message_docs_file;
            }

        }

        // cv
        // interview notes
        // documents

        return response()->json(
            [
                'status' => true,
                'message' => 'success',
                'data' => $applicants,
            ]
        );

    }

    public function apply(Request $request)
    {
        $applyForJob = "Start Internal Candidate Job Application(Candidate)";
        $internalapplicant = (object) [
            'email' => $request->cv['email'],
            'name' => $request->cv['first_name']." ".$request->cv['last_name'],
        ];
        mixPanelRecord($applyForJob, $internalapplicant);
        //validate request via company api_key
        if (!$req_header = $request->header('X-API-KEY')) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Bad Request, make sure your request format is correct',
                    'data' => [],
                ],
                400
            );
        }

        $job = Job::with('company')->where('id',$request->application['job_id'])->first();

        if ($job->is_private) {
            
            $checkEmail = PrivateJob::with('job')->where('attached_email', $request->cv['email'])->first();
            
            if (empty($checkEmail) || is_null($checkEmail)) {

                $jobPrivate = "Internal Candidate Job Application is for private(Candidate)";
                mixPanelRecord($jobPrivate,$internalapplicant);

                return response()->json([
                    'status' => false,
                    'message' => 'You are not listed to apply for this job',
                    'data' => null,
                ]);
            }
        }

        $owned_cvs = CV::where('email', $request->cv['email'])->pluck('id');
        $owned_applicataions_count = JobApplication::whereIn('cv_id', $owned_cvs)->where(
            'job_id',
            $request->application['job_id']
        )->count();


        if ($owned_applicataions_count > 0) {

            $oldCandidate = "Internal Candidate Has Applied Previously(Candidate)";
            mixPanelRecord($oldCandidate,$internalapplicant);

            return response()->json(
                [
                    'status' => false,
                    'message' => 'You have already applied for this job',
                    'data' => null,
                ]
            );
        }
        if(isset($request->cv['cv_file']) && isset($request->cv['cv_file_name']))//save cv
        {
            saveFileFromHrms($request->cv['cv_file_name'],$request->cv['cv_file']); 
        }

        $time = Carbon::now()->toDatetimeString();

        $cv = new Cv();
        $cv->first_name = isset($request->cv['first_name']) ? $request->cv['first_name'] : null;
        $cv->last_name = isset($request->cv['last_name']) ? $request->cv['last_name'] : null;
        $cv->other_name = isset($request->cv['other_name']) ? $request->cv['other_name'] : null;
        $cv->email = isset($request->cv['email']) ? $request->cv['email'] : null;
        $cv->phone = isset($request->cv['phone']) ? $request->cv['phone'] : null;
        $cv->gender = isset($request->cv['gender']) ? $request->cv['gender'] : null;
        $cv->date_of_birth = null;
        $cv->state = isset($request->cv['state']) ? $request->cv['state'] : null;
        $cv->cv_source = isset($request->cv['cv_source']) ? $request->cv['cv_source'] : null;
        $cv->cv_file = isset($request->cv['cv_file_name']) ? $request->cv['cv_file_name']: null;
        $cv->applicant_type = $request->cv['applicant_type'];
        $cv->hrms_staff_id = isset($request->cv['staff_id']) ? $request->cv['staff_id'] : null;
        $cv->hrms_grade = isset($request->cv['grade']) ? $request->cv['grade'] : null;
        $cv->hrms_dept = isset($request->cv['dept']) ? $request->cv['dept'] : null;
        $cv->hrms_location = isset($request->cv['location']) ? $request->cv['location'] : null;
        $cv->hrms_length_of_stay = isset($request->cv['length_of_stay']) ? $request->cv['length_of_stay'] : null;
        $cv->save();

        $candidate = Candidate::where('email', $request->cv['email'])->first();

        if ($candidate == null) {
            $candidate = new Candidate();
            $candidate->email = isset($request->cv['email']) ? $request->cv['email'] : null;
            $candidate->first_name = isset($request->cv['first_name']) ? $request->cv['first_name'] : null;
            $candidate->last_name = isset($request->cv['last_name']) ? $request->cv['last_name'] : null;
            $candidate->is_from = 'internal';
            $candidate->company_id = isset($request->cv['company_id']) ? $request->cv['company_id'] : null;
            $candidate->save();
        }

        $job_application = new JobApplication();
        $job_application->cv_id = $cv->id;
        $job_application->job_id = isset($request->application['job_id']) ? $request->application['job_id'] : null;
        $job_application->cover_note = isset($request->application['cover_note']) ? $request->application['cover_note'] : null;
        $job_application->status = isset($request->application['status']) ? $request->application['status'] : null;
        $job_application->is_approved = isset($request->application['is_approved']) ? $request->application['is_approved'] : null;
        $job_application->created = $time;
        $job_application->action_date = $time;
        $job_application->candidate_id = $candidate->id;

        $job_application->save();


        if (isset($request->form_fields) && !empty($request->form_fields)) {
            foreach ($request->form_fields as $form_field) {
                $form_field_value = new FormFieldValues();
                $form_field_value->form_field_id = $form_field['form_field_id'];

                if($form_field['is_file'] == true){ //save the file coming from hrms and then save the filename as value
                    saveFileFromHrms($form_field['file_name'],$form_field['value']);
                    $form_field_value->value =  $form_field['file_name'];
                }else{
                    $form_field_value->value = $form_field['value'];
                } 
                $form_field_value->job_application_id = $job_application->id;
                $form_field_value->save();
            }
        }

        $jobApplied = "Internal Candidate Job Application was Successful(Candidate)";
        mixPanelRecord($jobApplied, $candidate);
        // send email for new job email
        dispatch(new JobApplicationSuccessful($candidate));

        UploadApplicant::dispatch($job_application)->onQueue('solr');

        return response()->json(
            [
                'status' => true,
                'message' => 'success',
                'data' => null,
            ]
        );

    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Psr\Http\Message\ResponseInterface
     */
    public function fetchEmployees()
    {
        $client = new Client();
        $company = get_current_company();
        $api_key = $company->api_key;
        try {
            $result = $client->get(
                getEnvData('STAFFSTRENGTH_URL', null,request()->clientId) . '/admin/employees/api/get/all/employees',
                [
                    'headers' => ['Authorization' => $api_key],
                    'verify' => false,
                ]
            );
            if ($result->getStatusCode() == 200) {
                $result = json_decode($result->getBody()->getContents())->data;
            }

            return $result;
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }

    public function createSuperAdmin(Request $request)
    {

        $req_header = $request->header('X-API-KEY');
        if (!$req_header) {
            return response()->json([
                'status' => false,
                'message' => 'No API Key',
            ],
                400
            );
        }

        $company = Company::where('client_id', $request->clientId)->where('hrms_id', $request->company_id)->first();

        if (is_null($company)) {
            return response()->json([
                'status' => false,
                'message' => 'No company has being set up on this platform',
            ],
                400
            );
        }

        if ($req_header != $company->api_key) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid API Key',
            ],
                400
            );
        }

        if (!$request->name || !$request->email) {
            return response()->json([
                'status' => false,
                'message' => 'Name and employee email required',
            ],
                400
            );
        }

        $user = User::whereName($request->name)->whereEmail($request->email)->where('client_id', $request->clientId)->first();

        if (!is_null($user)) {
            return response()->json([
                'status' => false,
                'message' => 'User already exist',
            ],
                400
            );

        }

        //formerly firstOrCreate but  started failing hence get user in db that already has the email , otherwise create one
        $user = User::whereEmail($request->email)->first() ?: new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->is_internal = 1;
        $user->activated = 1;
        $user->is_super_admin = 1;
        $user->client_id = $request->clientId;
        $user->save();

        $role = Role::whereName('admin')->first()->id;

        $company->users()->attach($user->id, ['role' => $role]);
    
        $user->roles()->attach([$role]);

        return response()->json([
                'status' => true,
                'message' => 'created successfully',
            ]
        );


    }

    /**
     * [getUserJobs description]
     * @param Request $request [description]
     * @return array            [description]
     */
    public function getUserJobs(Request $request)
    {
        $candidate = Candidate::with('applications')->where('email', $request->email)->first();

        if ($candidate == null) {
            return response()->json(['status' => false, 'message' => 'user not found']);
        }

        //Get All jobs applied to
        if ($candidate->applications) {

            $job_ids = $candidate->applications->unique('job_id')->pluck('job_id')->toArray();

            $jobs = [];
            foreach ($candidate->applications as $key => $application) {
                $job = Job::with(['activities' => function ($q) use ($application) {
                    $q->where('job_application_id', $application->id)->get();
                }])->find($application->job_id);
                $job->application = $application;
                $job->messages = $application->messages;
                array_push($jobs, $job->toArray());
            }
        }

        return response()->json(
            [
                'success' => true,
                'data' => $jobs, $candidate, $candidate->applications,
            ]
        );
    }

    /**
     * [getUserJobActivities description]
     * @param Request $request [description]
     * @return array            [description]
     */
    public function getUserJobActivities(Request $request)
    {
        \Log::info($request->toArray());
        $candidate = Candidate::with('applications')->where('email', $request->email)->first();

        if ($candidate == null) {
            return response()->json(['status' => false, 'message' => 'user not found']);
        }

        $job = Job::find($request->job_id);
        $activities = JobActivity::where('job_id', $request->job_id)
            ->where('job_application_id', $request->application_id)
            ->get();

        return response()->json(
            [
                'success' => true,
                'data' => [
                    'activities' => $activities,
                    'job' => $job,
                ],
            ]
        );

    }

}

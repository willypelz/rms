<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Libraries\Solr;
use App\Models\Candidate;
use App\Models\Cv;
use App\Models\FormFieldValues;
use App\Models\JobApplication;
use App\Models\Role;
use App\Models\Workflow;
use Illuminate\Http\Request;
use App\Models\JobBoard;
use App\Models\Job;
use App\Models\Specialization;
use App\Models\Company;
use App\Models\FormFields;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\User;
use App\Models\JobActivity;

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

    /**
     * TODO: This code so need to be refactored in the future
     *
     * @param Request $request
     * @param string $jobType
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function company(Request $request, $jobType = 'all')
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

        // Get company and its jobs
        $company = Company::with(
            [
                'jobs' => function ($query) use ($jobType) {
                    $query->with(['workflow.workflowSteps'])
                        ->whereStatus("ACTIVE")
                        ->orderBy('created_at', 'desc')
                        ->where('expiry_date', '>', date('Y-m-d'));
                    if ($jobType != 'all') {
                        $query->whereIsFor($jobType); // default $jobType == external
                    }
                }
                ,
                'jobs.form_fields',
                'jobs.specializations',
                'jobs.company',
            ]
        )->whereApiKey($req_header)
            ->first();

        if (!$company) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Unauthorized!.',
                    'data' => [],
                ],
                401
            );
        }

        $company->logo = File::exists(public_path('uploads/'.@$company->logo))
            ? asset('uploads/'.@$company->logo)
            : $company->logo = asset('img/company.png');

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
                'applicantsViaJAT' => function ($q) use ($status_slug
                ) { // applicant via JAT, JAT - Job Applications Table
                    if ($status_slug != 'ALL') {
                        $q->whereStatus($status_slug);
                    }
                    $q->with('cv');
                },
            ]
        )->find($job_id)->applicantsViaJAT;

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

        $owned_cvs = CV::where('email', $request->cv['email'])->pluck('id');
        $owned_applicataions_count = JobApplication::whereIn('cv_id', $owned_cvs)->where(
            'job_id',
            $request->application['job_id']
        )->get()->count();


        if ($owned_applicataions_count > 0) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'You have already applied for this job',
                    'data' => null,
                ]
            );
        }

        $time = Carbon::now()->toDatetimeString();

        $cv = new Cv();
        $cv->first_name = isset($request->cv['first_name']) ? $request->cv['first_name'] : null;
        $cv->last_name = isset($request->cv['last_name']) ? $request->cv['last_name'] : null;
        $cv->other_name = isset($request->cv['other_name']) ? $request->cv['other_name'] : null;
        $cv->email = isset($request->cv['email']) ? $request->cv['email'] : null;
        $cv->phone = isset($request->cv['phone']) ? $request->cv['phone'] : null;
        $cv->gender = isset($request->cv['gender']) ? $request->cv['gender'] : null;
        $cv->date_of_birth = isset($request->cv['date_of_birth']) ? $request->cv['date_of_birth'] : null;
        $cv->state = isset($request->cv['state']) ? $request->cv['state'] : null;
        $cv->cv_source = isset($request->cv['cv_source']) ? $request->cv['cv_source'] : null;
        $cv->save();

        $job_application = new JobApplication();
        $job_application->cv_id = $cv->id;
        $job_application->job_id = isset($request->application['job_id']) ? $request->application['job_id'] : null;
        $job_application->cover_note = isset($request->application['cover_note']) ? $request->application['cover_note'] : null;
        $job_application->status = isset($request->application['status']) ? $request->application['status'] : null;
        $job_application->is_approved = isset($request->application['is_approved']) ? $request->application['is_approved'] : null;
        $job_application->created = $time;
        $job_application->action_date = $time;
        $job_application->save();

        if (isset($request->form_fields) && !empty($request->form_fields)) {
            foreach ($request->form_fields as $form_field) {
                $form_field_value = new FormFieldValues();
                $form_field_value->form_field_id = $form_field->form_field_id;
                $form_field_value->value = $form_field->value;
                $form_field_value->job_application_id = $job_application->id;
                $form_field_value->save();
            }
        }


        Solr::update_core();

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
                env('STAFFSTRENGTH_URL').'/admin/employees/api/get/all/employees',
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
            return response()->json(
                [
                    'status' => false,
                    'message' => 'No API Key',
                ],
                400
            );
        }

        $current_company = Company::get()->first();

        if ($req_header != $current_company->api_key) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Invalid API Key',
                ],
                400
            );
        }

        if (!$request->name || !$request->email) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Name and employee email required',
                ],
                400
            );
        }
        $user_found = User::whereName($request->name)->whereUsername($request->username)->whereEmail($request->email)->first();
        $user = $user_found ? $user_found->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'is_internal' => 1,
                'activated' => 1,
                'is_super_admin' => 1,
            ]
        ) : User::firstOrCreate(
            [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'is_internal' => 1,
                'activated' => 1,
                'is_super_admin' => 1,
            ]
        );
        $role = Role::whereName('admin')->first();

        if ($user_found && $user_found->roles->count()) {
            $user_found->roles()->detach();
        }
        if($user instanceof Illuminate\Database\Eloquent\Collection) {
            $user->attachRole($role);
            if(!$current_company->users()->where('user_id', $user->id)->first()) {
                $current_company->users()->sync([$user->id => ['role' => $role]], false);
            }
        }elseif($user_found instanceof Illuminate\Database\Eloquent\Collection) {
            $user_found->attachRole($role);
            if(!$current_company->users()->where('user_id', $user_found->id)->first()) {
                $current_company->users()->sync([$user_found->id => ['role' => $role]], false);
            }
        }



        return response()->json(
            [
                'status' => true,
                'message' => 'created successfully',
            ]
        );

    }

    /**
     * [getUserJobs description]
     * @param  Request $request [description]
     * @return array            [description]
     */
    public function getUserJobs(Request $request)
    {
        $candidate = Candidate::with('applications')->where('email', $request->email)->first();

        if ($candidate == null) {
            return response()->json(['status' => false, 'message' => 'user not found']);
        }

        \Log::info($candidate->toArray());

        //Get All jobs applied to
        if ($candidate->applications) {

            $job_ids = $candidate->applications->unique('job_id')->pluck('job_id')->toArray();

            $jobs = [];
            foreach ($candidate->applications as $key => $application) {
                $job = Job::find($application->job_id);
                $job->application = $application;
                array_push($jobs, $job->toArray());
            }
        }

        return response()->json(
            [
                'success' => true,
                'data' => $jobs,
            ]
        );
    }

    /**
     * [getUserJobActivities description]
     * @param  Request $request [description]
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

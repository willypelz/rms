<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Workflow;
use Illuminate\Http\Request;
use App\Models\JobBoard;
use App\Models\Job;
use App\Models\Specialization;
use App\Models\Company;
use App\Models\FormFields;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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
        'grouped' => false
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
        'Zamfara'
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
            'Others'

        ];

        $this->mailer = $mailer;


    }

    private function _confirmIntegrity($api_key)
    {
        if (!$company = Company::whereApiKey($api_key)->first()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized!.',
                'data' => []
            ], 401);
        }
    }

    /**
     * TODO: This code so need to be refactored in the future
     *
     * @param Request $request
     * @param string  $jobType
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function company(Request $request, $jobType = 'all')
    {
        //validate request via company api_key
        if (!$req_header = $request->header('X-API-KEY')) {
            return response()->json([
                'status' => false,
                'message' => 'Bad Request, make sure your request format is correct',
                'data' => []
            ], 400);
        }

        // Get company and its jobs
        $company = Company::with([
            'jobs' => function ($query) use ($jobType) {
                $query->with(['workflow.workflowSteps'])
                    ->whereStatus("ACTIVE")
                    ->orderBy('created_at', 'desc')
                    ->where('expiry_date', '>', date('Y-m-d'));
                if ($jobType != 'all') {
                    $query->whereIsFor($jobType); // default $jobType == external
                }
            }
        ])->whereApiKey($req_header)
            ->first();

        if (!$company) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized!.',
                'data' => []
            ], 401);
        }

        $company->logo = File::exists(public_path('uploads/' . @$company->logo))
            ? asset('uploads/' . @$company->logo)
            : $company->logo = asset('img/company.png');

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $company
        ]);

    }

    public function applicants(Request $request, $job_id, $status_slug)
    {
        //validate request via company api_key
        if (!$req_header = $request->header('X-API-KEY')) {
            return response()->json([
                'status' => false,
                'message' => 'Bad Request, make sure your request format is correct',
                'data' => []
            ], 400);
        }

        if (!$company = Company::whereApiKey($req_header)->first()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized!.',
                'data' => []
            ], 401);
        }

        $status_slug = strtoupper($status_slug);

        $applicants = Job::with([
            'applicants' => function ($q) use ($status_slug) {
                if ($status_slug != 'ALL') {
                    $q->whereStatus($status_slug);
                }
                $q->with('cv');
            }
        ])->find($job_id)->applicants;

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $applicants
        ]);

    }

}

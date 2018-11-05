<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Workflow;
use Illuminate\Http\Request;
use App\Models\JobBoard;
use App\Models\Job;
use App\Models\Specialization;
use App\Models\Company;
use App\Models\FormFields;
use App\User;
use Validator;
use Cart;
use Session;
use Auth;
use Mail;
use Curl;
use Carbon\Carbon;
use DB;
use Crypt;
use File;
use Illuminate\Mail\Mailer;
use Charts;

// use Zipper;

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
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth', [
            'except' => [
                'JobView',
                'company',
                'jobApply',
                'JobApplied',
                'JobVideoApplication',
                'getEmbed',
                'getEmbedTest',
                'acceptInvite',
                'declineInvite',
            ]
        ]);

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

    public function PostJob(Request $request)
    {
        $application_fields = config('constants.application_fields');
        $qualifications     = qualifications();
        $locations          = locations();
        $specializations    = Specialization::get();

        $user       = Auth::user();
        $company    = get_current_company();
        $job_boards = JobBoard::where('type', 'free')->get()->toArray();
        $c          = (count($job_boards) / 2);
        $t          = array_chunk($job_boards, $c);
        $board1     = $t[0];
        $board2     = $t[1];
        $urls       = [];
        foreach ($job_boards as $s) {
            $bds[]          = ($s['id']);
            $urls[$s['id']] = "";
        }

        //Free Job boards urls
        $insidify_url = "";

        // dd($job_bards);
        if ($request->isMethod('post')) {

            $pickd_boards = [1];
            // dd( $request->all() );


            $data = [
                'job_title' => $request->job_title,
                'job_location' => $request->job_location,
                'details' => $request->details,
                'job_type' => $request->job_type,
                'position' => $request->position,
                // 'post_date' => $request->post_date,
                'expiry_date' => $request->expiry_date,
                'workflow_id' => $request->workflow_id
            ];

            $validator = Validator::make($data, [
                'job_title' => 'required',
                'job_location' => 'required',
                'details' => 'required',
                'job_type' => 'required',
                'position' => 'required',
                'expiry_date' => 'required',
                'workflow_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                // dd('Success');
                $pickd_boards = [1];

                //get field visibilities
                $fields = [];

                foreach ($application_fields as $key => $application_field) {
                    $fields[$key] = [
                        'is_required' => (isset($request->is_required[$key])) ? 1 : 0,
                        'is_visible' => (isset($request->is_visible[$key])) ? 1 : 0,
                    ];
                }

                $job_data = [
                    'title' => $request->job_title,
                    'location' => $request->job_location,
                    'details' => $request->details,
                    'job_type' => $request->job_type,
                    'position' => $request->position,
                    'post_date' => date('Y-m-d'),
                    'expiry_date' => $request->expiry_date,
                    'status' => 'ACTIVE',
                    'company_id' => $company->id,
                    'workflow_id' => $request->workflow_id,
                    'fields' => json_encode($fields),
                ];

                $job = Job::FirstorCreate($job_data);

                //Send New job notification email
                $to   = 'support@seamlesshr.com';
                $mail = Mail::send('emails.new.job-application',
                    ['job' => $job, 'boards' => null, 'company' => $company], function ($m) use ($company, $to) {
                        $m->from($to, @$company->name);

                        $m->to($to)->subject('New Job initiated');
                    });

                // $insidify_url = Curl::to("https://insidify.com/ss-post-job")
                //             ->withData(  [ 'secret' => '1ns1d1fy', 'data' =>  [ 'job' => $job_data, 'specializations' => @$request->specializations, 'company' => get_current_company()->toArray(), 'action_link' => url('job/apply/'.$job->id.'/'.str_slug($job->title) ) ]  ]  )
                //             // ->asJson()
                //             ->post();
                // $urls[1] = $insidify_url;
                //
                $urls[1] = "";
                // dd( [ 'job' => $job_data, 'specializations' => $request->specializations, 'insidify_url' => $insidify_url, 'company' => get_current_company()->toArray(), 'action_link' => url('job/apply/'.$job->id.'/'.str_slug($job->title) ) ] );

                //Save job creation to activity
                save_activities('JOB-CREATED', $job->id);

                //save custom fields
                if (isset($request->custom_names) and $request->custom_names != null) {
                    $custom_data = [];
                    for ($i = 0; $i < count($request->custom_names); $i++) {
                        $custom_data[] = [
                            'name' => $request->custom_names[$i],
                            'type' => $request->custom_types[$i],
                            'options' => $request->custom_options[$i],
                            'is_required' => $request->custom_required[$i],
                            'is_visible' => $request->custom_visible[$i],
                            'job_id' => $job->id,
                        ];
                    }
                    FormFields::insert($custom_data);
                }

                $out_boards = [];
                foreach ($pickd_boards as $p) {
                    if (in_array($p, $bds)) {
                        $job->boards()->attach($p, ['url' => $urls[$p]]);
                    }
                    $out_boards[] = JobBoard::where('id', $p)->first()->name;
                }
                $flash_boards = implode(', ', $out_boards);

                foreach ($request->specializations as $e) {
                    $job->specializations()->attach($e);
                }

            }

            Session::flash('flash_message',
                'Congratulations! Your job has been posted on ' . $flash_boards . '. You will begin to receive applications from those job boards shortly - <i>this is definite</i>.');
            return redirect()->route('post-success', ['jobID' => $job->id]);
        }

        $workflows = Workflow::whereCompanyId(get_current_company()->id)->get();

        return view('job.create', compact(
            'qualifications',
            'specializations',
            'board1',
            'board2',
            'locations',
            'workflows',
            'application_fields'
        ));
    }

    public function company($c_url)
    {

        $company = Company::with([
            'jobs' => function ($query) {
                $query->where('status', "ACTIVE")
                    ->orderBy('created_at', 'desc')
                    ->where('expiry_date', '>', date('Y-m-d'))
                    ->whereIsFor('internal');
            }
        ])->where('slug', $c_url)->first();

        // $company->jobs()->orderBy('created_at','desc')->get()->toArray();
        // dd($company);

        $company->logo = File::exists(public_path('uploads/' . @$company->logo))
            ? asset('uploads/' . @$company->logo)
            : $company->logo = asset('img/company.png');

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $company
        ]);

    }

    public function getUID(Request $request)
    {
        // allow origin
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        // add any additional headers you need to support here
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With,X-Auth-Token, Origin');

        list($id, $email, $created_at, $company_id) = explode('~&', Crypt::decrypt($request->key));

        // var_dump($id, $email, $created_at);

        $user = User::with('companies')->whereHas('companies', function ($query) use ($company_id) {
            $query->where('company_id', $company_id);
        })
            ->where('id', $id)
            // ->where('email', $email."")
            ->where('created_at', $created_at)->first();

        if ($user->exists()) {
            $company = Company::find($company_id);
            $jobs    = $company->jobs()->orderBy('created_at', 'desc')->get()->toArray();
        } else {
            $company = null;
            $jobs    = "Invalid Key";
        }
        return view('guest.embed-view', compact('jobs', 'user', 'company'));
    }


}

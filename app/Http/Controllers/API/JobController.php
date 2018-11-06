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

    public function company($slug)
    {
        //validate request via company api_key

        $company = Company::with([
            'jobs' => function ($query) {
                $query->where('status', "ACTIVE")
                    ->orderBy('created_at', 'desc')
                    ->where('expiry_date', '>', date('Y-m-d'))
                    ->where(function ($q) { // fetch both internal and external jobs to show on staffstrength
                        $q->where('is_for', 'internal')
                            ->orWhere('is_for', 'external');
                    });
            }
        ])->where('slug', $slug)->first();

        $company->logo = File::exists(public_path('uploads/' . @$company->logo))
            ? asset('uploads/' . @$company->logo)
            : $company->logo = asset('img/company.png');

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $company
        ]);

    }

}

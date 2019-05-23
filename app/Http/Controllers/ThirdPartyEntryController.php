<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThirdPartyEntryController extends Controller
{
    public function index(Request $request)
    {
        if (!$req_header = $request->input('_api_key')) {
            return redirect('/login', 301)->withErrors([
                'warning' => 'Bad Request, make sure your request format is correct'
            ]);
        }

        if (!$company = Company::whereApiKey($req_header)->first()) {
            return redirect('/login', 301)->withErrors([
                'warning' => 'Invalid third-party login, please login with your account details'
            ]);
        }

        $userData = collect($request->input('user_data'));
        $formData = $request->input('form_data');
        $formData['api_key'] = $request->input('_api_key');
        $formData['callback_url'] = $request->input('callback_url');
        $formData['requisition_id'] = $request->input('requisition_id');
        $formData['job_description'] = $request->input('job_description');
        // Get all data coming in from thirdparty website
        if ($request->input('intended_action') == 'post-job') {
            // firstOrCreate user account and auth user
            $user            = User::firstOrNew(['email' => $userData->get('email')]);
            $user->name      = $userData->get('full_name');
            $user->activated = 1;
            $user->save();

            // sync company relationship
            $company->users()->syncWithoutDetaching([$user->id]);
            // auth user and set the remember token
            Auth::login($user, true);

            $redirect_url = $request->input('intended_url');
        } else {
            // default to applying for a job, firstOrCreate user account and auth user
            $candidate = Candidate::firstOrNew(['email' => $userData->get('email')]);
            list($fname, $lname) = explode(' ', $userData->get('full_name'));
            $candidate->first_name = $fname;
            $candidate->last_name  = $lname;
            $candidate->is_from    = 'internal';
            $candidate->company_id = $company->id;
            $candidate->save();
            // auth user and set the remember token
            Auth::guard('candidate')->login($candidate, true);

            $redirect_url = $request->input('intended_url');
        }
        \Log::info($formData);

        // store the form_data in session for retrival on job posting page
        session(['third_party_data' => $formData]);

        return redirect($redirect_url);
    }
}

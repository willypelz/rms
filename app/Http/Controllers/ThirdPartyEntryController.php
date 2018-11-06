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
        if (!$company = Company::whereApiKey($request->input('_api_key')->first())) {
            return redirect('/login')->withErrors('Invalid third-party login, please login with your account details');
        }

        $userData = $request->input('user_data');

        // Get all data coming in from thirdparty website
        if ($request->input('intended_action') == 'post-job') {
            // firstOrCreate user account and auth user
            $user = User::firstOrCreate($userData);
            // sync company relationship
            $company->users()->syncWithoutDetaching([$user->id]);
            // auth user and set the remember token
            Auth::login($user, true);

            $redirect_url = route('post-job');
        } else {
            // default to applying for a job, firstOrCreate user account and auth user
            $candidate = Candidate::firstOrCreate($userData);
            // auth user and set the remember token
            Auth::guard('candidate')->login($candidate, true);

            $redirect_url = $request->input('intended_url');
        }

        // store the form_data in session for retrival on job posting page
        session(['third_party_data' => $request->input('form_data')]);

        return redirect($redirect_url);

        // [
        //     '_api_key' => 'ab5c5eee-5180-4291-bcbf-b06d070c6327',
        //     'user_data' => [
        //         'name' => 'Michael Akanji',
        //         'email' => 'mat@example.com',
        //     ],
        //     'form_data' => [
        //         // nothing to set here until
        //     ],
        //     'intended_action' => 'apply-to-job',
        //     'intended_url' => 'https://link.to/posted/job-from/staffstrength',
        // ];
    }
}

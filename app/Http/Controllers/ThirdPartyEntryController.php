<?php

namespace App\Http\Controllers;

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

        // Get all data coming in from thirdparty website
        if ($request->input('intended_action') == 'post-job') {
            // firstOrCreate user account and auth user
            $adminUser = User::firstOrCreate($request->input('user_data'));
            // sync company relationship
            $company->users()->syncWithoutDetaching([$adminUser->id]);
            // auth user and set the remember token
            Auth::login($adminUser, true);
        } else {
            // default to applying for a job, firstOrCreate user account and auth user

        }

        return redirect();

        // [
        //     '_api_key' => 'ab5c5eee-5180-4291-bcbf-b06d070c6327',
        //     'user_data' => [
        //         'full_name' => 'Michael Akanji',
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

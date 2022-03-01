<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SetupController extends Controller
{
    public function index()
    {
        $currentUrl = url('');
        $client = DB::table('clients')->where('url', $currentUrl)->first();
        $company = Company::where('client_id',$client->id)->where('id', get_current_company()->id)->first();

        if (!$company) {
            $company = Company::where('client_id',$client->id)->first();
        }

        $apiKey = optional($company)->api_key;

        $hrmsUrl = optional(getSystemConfig())->STAFFSTRENGTH_URL;

        return view('setup.index', compact('apiKey', 'hrmsUrl'));
    }

    public function generateApiKey()
    {
        $key = Str::uuid();

        if (Company::where('api_key', $key)->first()) {
            return $this->generateApiKey();
        }

        return response()->json(['success' => true, 'data' => $key]);
    }

    public function saveSetup()
    {
        $currentUrl = url('');
        $client = DB::table('clients')->where('url', $currentUrl)->first();
        $company = Company::where('client_id',$client->id)->where('id', get_current_company()->id)->first();

        if (!$company) {
            $company = Company::where('client_id',$client->id)->first();
        }

        $company->update(['api_key' => \request()->api_key]);

        SystemSetting::updateOrCreate([
            'client_id' => $client->id,
            'key' => 'STAFFSTRENGTH_URL'
        ], ['value' => \request()->hrms_url]);

        $url = \request()->hrms_url . 'api/v1/rms-config/update';

        $body = [
            'rms_url' => url(''),
            'api_key' => \request()->api_key,
            'company_id' => $company->hrms_id
        ];

        $resp = Http::withoutVerifying()->post($url, $body);

        if (!$resp->successful()) {
            session()->flash('error', 'Update unsuccessful');
        } else {
            session()->flash('success', 'Updated successfully');
        }

        return back();
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\Company;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;

class SyncController extends Controller
{
    //get companies and it's subsidiaries
    public function companyAndSubsidiaries()
    {
        $rmsCompany = Company::whereNotNull('api_key')->first();
        if(config('app.staff_strength_url') && env('RMS_STAND_ALONE')==false && $rmsCompany)
        {
	        $response = Curl::to(env('STAFFSTRENGTH_URL') . 'api/v2/company-subsidiaries/'. base64_encode($rmsCompany->api_key))
            ->get();
        }

        $hrmsCompanies = json_decode($response)->data;

        foreach ($hrmsCompanies as  $hrmsCompany) {
	        if (($hrmsCompany->api_key)) {
		        if ($hrmsCompany->api_key->value == $rmsCompany->api_key) {
			        $rmsCompany->hrms_id = $hrmsCompany->id;
			        $rmsCompany->is_default = $hrmsCompany->is_default;
			        $rmsCompany->is_active = $hrmsCompany->is_active;
			        $rmsCompany->save();
		        } else {
			        Company::create([
				        'name' => $hrmsCompany->name,
				        'email' => $hrmsCompany->email,
				        'logo' => $hrmsCompany->logo,
				        'phone' => $hrmsCompany->phone,
				        'website' => $hrmsCompany->website,
				        'about' => $hrmsCompany->about,
				        'address' => $hrmsCompany->address,
				        'date_added' => now(),
				        'is_active' => $hrmsCompany->is_active,
				        'is_default' => $hrmsCompany->is_default,
				        'hrms_id' => $hrmsCompany->id,
			        ]);
		        }
	        }
        }

        return response()->json($hrmsCompanies);
    }
}

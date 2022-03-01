<?php

namespace App\Http\Controllers\API;

use App\Models\Company;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;
use App\Enum\Configs;

class SyncController extends Controller
{
    public function companyAndSubsidiaries()
    {
        try {
            $rmsCompany = Company::whereNotNull('api_key')->first();
            if (getEnvData('STAFFSTRENGTH_URL', null, request()->clientId) && getEnvData('RMS_STAND_ALONE', null, request()->clientId) == false && $rmsCompany) {
                $response = Curl::to(getEnvData('STAFFSTRENGTH_URL', null, request()->clientId) . Configs::COMPANY_SUBSIDIARIES .
                    base64_encode($rmsCompany->api_key))->get();
            }

            $hrmsCompanies = json_decode($response)->data;

            foreach ($hrmsCompanies as $hrmsCompany) {
                if (($hrmsCompany->api_key)) {
                    if ($hrmsCompany->api_key->value == $rmsCompany->api_key) {
                        $rmsCompany->hrms_id = $hrmsCompany->id;
                        $rmsCompany->is_default = $hrmsCompany->is_default;
                        $rmsCompany->is_active = $hrmsCompany->is_active;
                        $rmsCompany->save();
                    } else {
                        self::createCompanyWithHrmsDetails($hrmsCompany);
                    }
                } else if ($hrmsCompany->email !== $rmsCompany->email) {
                    self::createCompanyWithHrmsDetails($hrmsCompany);
                }
            }
	        if((request()) && request()->json) return response()->json($hrmsCompanies);
	        return back()->with('success', 'Syncing successful');
        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }

    public function createCompanyWithHrmsDetails($hrmsCompany){
	  return  Company::create([
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
            'license_type'=>'PREMIUM'
	    ]);
    }
}

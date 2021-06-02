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
        if(env('STAFFSTRENGTH_URL') && env('RMS_STAND_ALONE')==false && $rmsCompany)
        {
            $response = Curl::to(env('STAFFSTRENGTH_URL') . 'Api/v2/company-subsidiaries/'. base64_encode($rmsCompany->api_key))
            ->get();
        }
        $hrmsCompany = json_decode($response);

        
        foreach ($hrmsCompany as  $value) {
            # code...
            if ($value->email == $rmsCompany->email) {
                # code...
            }
            
        }

        return response()->json($rmsCompany);
    }
}

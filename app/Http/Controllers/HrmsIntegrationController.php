<?php

namespace App\Http\Controllers;

use App\Libraries\Solr;
use App\User;
use Illuminate\Http\Request;


class HrmsIntegrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }
    /**
     * Delete an admin from hrms.
     * @param App\Http\Requests
     * @return Illuminate\Http\Response
     */
    public function deleteSuperAdmin(Request $request)
    {
        $data  = [
            "email" => "required",
            "name" => "required",
            "username" => "nullable"
        ];

        $data = $request->validate($data);
        $apiKey = $request->header('X-API-KEY');
        
        $user = User::where("email", base64_decode($data["email"]))->first();
        $authorized = $user->companies()->where("api_key", $apiKey)->first();
        if($user && $authorized){
            $data = $user;
            $user->delete();
            return response()->json(["status"=>"success", "msg"=>"Admin Deleted Successfully"], 200);
        }
        return response()->json(["status"=>"error", "msg"=>"Operation Admin Delete Not Successful"], 401);
    }

}

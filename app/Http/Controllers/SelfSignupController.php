<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Services\SelfSignUpService;
use App\Http\Requests\SignUpRequest;

class SelfSignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
            return view('guest.self-sign-up.signup');  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SignUpRequest $request, SelfSignUpService $signup)
    {
        try{
             
           DB::transaction(function () use($request, $signup) {
                 $user_sign_up =  $signup->createDomain($request);
                 if($user_sign_up){
                       return response()->json(['status'=>true, 'msg'=>'Account created successfully, please check your email']);
                 }
            });
        }catch(\Exception $e){
            info($e);
            return response()->json(['status'=>false, 'msg'=> $e->getMessage()]);
        }
           
    }

}

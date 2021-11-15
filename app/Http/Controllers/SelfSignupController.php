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
                       return response()->json(['status'=>true, 'msg'=>'Account creation successful']);
                 }
            });
        }catch(\Exception $e){
            info($e);
            return response()->json(['status'=>false, 'msg'=> $e->getMessage()]);
        }
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

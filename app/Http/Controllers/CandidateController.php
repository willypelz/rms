<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Curl;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobActivity;
use App\Libraries\Solr;
use Auth;
use App\Models\FolderContent;
use Mail;


class CandidateController extends Controller
{
    public function login(Request $request)
    {

        $redirect_to = $request->redirect_to;
        if( Auth::guard('candidate')->check() )
        {
            // return redirect()->route('candidate-dashboard');
        }

        if( $request->isMethod('post') )
        {
            if( Auth::guard('candidate')->attempt(['email' => $request->email, 'password' => $request->password]) )
            {
                if( $request->redirect_to )
                {
                    return redirect( $request->redirect_to );
                }
                else{
                    return redirect()->route('candidate-dashboard');
                }

            }
            else{
                $request->session()->flash('error', "Invalid Credentials");
                return back();
            }
            
        }
        return view('candidate.login', compact('redirect_to'));
    }

    public function logout(Request $request)
    {
        Auth::guard('candidate')->logout();
    }
    public function dashboard(Request $request)
    {
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Curl;
use App\Models\Company;
use App\Models\Candidate;
use App\Models\Job;
use App\Models\JobActivity;
use App\Models\JobApplication;
use App\Libraries\Solr;
use Auth;
use App\Models\FolderContent;
use App\Models\Message;
use Mail;


class CandidateController extends Controller
{
 

    public function login(Request $request)
    {
        if( Auth::guard('candidate')->check() )
        {
            return redirect()->route('candidate-dashboard');
        }
        $redirect_to = $request->redirect_to;

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
        return redirect()->route('candidate-login');
    }

    public function register(Request $request)
    {

        $redirect_to = $request->redirect_to;

        

        if( $request->isMethod('post') )
        {
            $candidate = Candidate::firstOrCreate([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt( $request->password ),
            ]);
            if($candidate)
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
                    $request->session()->flash('error', "Could not register. Please try again.");
                    return back();
                }
            }
            
            
        }

        return view('candidate.register', compact('redirect_to'));
    }

    public function forgot(Request $request)
    {

        $redirect_to = $request->redirect_to;
        return view('candidate.forgot', compact('redirect_to'));
    }

    public function reset(Request $request)
    {
        $redirect_to = $request->redirect_to;
        return view('candidate.rest', compact('redirect_to'));
    }



    public function dashboard(Request $request)
    {
        if( !Auth::guard('candidate')->check() )
        {
            return redirect()->route('candidate-login', ['redirect_to' => url()->current() ]);
        }

        return view('candidate.dashboard');
    }

    public function activities(Request $request)
    {
        if( !Auth::guard('candidate')->check() )
        {
            return redirect()->route('candidate-login', ['redirect_to' => url()->current() ]);
        }

        $application_id = $request->application_id;
        $ignore_list = [
            'JOB-CREATED'
        ];
        $show_messages_tab = true;
        $activities = JobActivity::where('job_application_id',$application_id)->get();

        return view('candidate.activities', compact('application_id','ignore_list','show_messages_tab','activities'));
    }

    public function messages(Request $request)
    {
        if( !Auth::guard('candidate')->check() )
        {
            return redirect()->route('candidate-login', ['redirect_to' => url()->current() ]);
        }

        $application_id = $request->application_id;
        $messages = Message::where( 'job_application_id', $request->application_id )->get();
        return view('candidate.messages', compact('messages','application_id'));
    }

    public function sendMessage(Request $request)
    {

        if( $request->hasFile('attachment') )
        {
            $file_name  = (@$request->attachment->getClientOriginalName());
            $fi =  @$request->file('attachment')->getClientOriginalExtension(); 
            $attachment = $request->application_id.'-'.time().'-'.$file_name;

            $upload = $request->file('attachment')->move(
                env('fileupload'), $attachment
            );
        }
        else
        {
            $attachment = '';
        }

        Message::create([
            'job_application_id' => $request->application_id,
            'message' => $request->message,
            'attachment'=> $attachment,
        ]);
        $application_id = $request->application_id;

        return redirect()->route('candidate-messages', ['application_id' => $application_id]); 

    }
}

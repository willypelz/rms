<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Auth;
use Carbon\Carbon;


class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        if(Auth::check()){
            //audit trail for admin
            $last_login = Carbon::now()->toDateTimeString();

            $log_action = [
                'log_name' => "Admin Login",
                'description' => "Admin ". Auth::user()->name . " logged in. Last login was "  .$last_login,
                'action_id' => Auth::user()->id,
                'action_type' => 'App\User',
                'causee_id' => Auth::user()->id,
                'causer_id' => Auth::user()->id,
                'causer_type' => 'admin',
                'properties'=> ''
            ];

            logAction($log_action);
        }
        elseif(Auth::guard('candidate')->check()) {
            //audit trail for applicant
            $name = Auth::guard('candidate')->user()->first_name.' '.Auth::guard('candidate')->user()->last_name;
            $last_login = Carbon::now()->toDateTimeString();
            $log_action = [
                'log_name' => "Candidate Login",
                'description' => "An applicant ". $name . " logged in. Last login was " . $last_login,
                'action_id' => Auth::guard('candidate')->user()->id,
                'action_type' => 'App\Models\Candidate',
                'causee_id' => Auth::guard('candidate')->user()->id,
                'causer_id' => Auth::guard('candidate')->user()->id,
                'causer_type' => 'applicant',
                'properties'=> ''
            ];
            logAction($log_action);
          
        }
    }
}

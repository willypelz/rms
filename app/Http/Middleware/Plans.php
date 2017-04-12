<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Auth;

class Plans
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'login',
        'logout'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Auth::check() )
        {
            $current_company = get_current_company();
            $trial_time = Carbon::parse( $current_company->date_added );
            $now = Carbon::now();
            $diff = $now->diffInDays( $trial_time );

            $additional_request = [];

            $additional_request['status'] = $current_company->license_type;


            if( $current_company->license_type == 'TRIAL')
            {
                

                if( $diff > 14 )
                {
                    $additional_request["has_expired"] = true;
                    
                    if( url('pricing') != url()->current() )
                    {

                       return redirect()->to('pricing');   
                    }
                    $trial_time = 0;

                }
                else
                {
                    $additional_request["has_expired"] = false;
                    $trial_time = 14 - $diff;
                }

               

                $additional_request["trial_time"] = $trial_time;

                view()->share('account', (object) $additional_request);
                
                // $request->merge( $additional_request );

                return $next($request);
            }
            else
            {
                return $next($request);
            }

        }
        else
        {
            return $next($request);
        }
        

        
        
    }
}

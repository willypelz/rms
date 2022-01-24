<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Plans
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $exceptRoutes = [
        'login',
        'logout',
        'select-company',
        'add-company',
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request incomming request
     * @param \Closure                 $next    the next url
     * 
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($this->exceptRoutes as $route) {
            if ($request->route()->getName() == $route || $request->route()->uri == $route) {
                return $next($request);
            }
        }
        if (Auth::check() ) {
            $current_company = get_current_company();  
            if (!isset($current_company->id)) {
                return redirect()->route('logout');
            }
            $trial_time = Carbon::parse($current_company->date_added);
            $now = Carbon::now();
            $diff = $now->diffInDays($trial_time);

            $additional_request = [];
            $additional_request['status'] = $current_company->license_type;
            if ($current_company->license_type == 'TRIAL') {
                if ($diff > 28 ) {
                    $additional_request["has_expired"] = true;

                    if (url('pricing/page') != url()->current() ) {

                        return redirect()->route('pricing-page');
                    }
                    $trial_time = 0;

                } else {
                    $additional_request["has_expired"] = false;
                    $trial_time = 28 - $diff;
                }
                $additional_request["trial_time"] = $trial_time;
                // $request->merge( $additional_request );
            } else if ($current_company->license_type == 'PREMIUM') {
                $additional_request["has_expired"] = false;
                $additional_request["trial_time"] = 0;
            } else {
                $additional_request["has_expired"] = true;
                $additional_request["trial_time"] = 0;
            }
            view()->share('account', (object) $additional_request);
        } else {
            
        }

        return $next($request);
    }
}

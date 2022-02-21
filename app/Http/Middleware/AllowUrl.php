<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $dbUrl = getEnvData('APP_URL', null, request()->clientId);
            
            $currentURL = url('');

            if (substr($dbUrl, -1) == '/') {
                $dbUrl = substr($dbUrl, 0, -1);
                if ($currentURL == $dbUrl) {
                    return $next($request);
                }
            }
            
            abort(404);
            
        } catch (\Throwable $th) {
            abort(404);
        }
        
    }
}

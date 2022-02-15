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
            if (url('') == getEnvData("APP_URL", null, $request->clientId)) {
                return $next($request);
            }
            abort(404);
            
        } catch (\Throwable $th) {
            abort(404);
        }
        
    }
}

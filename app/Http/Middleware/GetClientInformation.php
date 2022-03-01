<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetClientInformation
{
    /**
     * Handle an incoming request and push the url into 
     * request body if it exists in clients tbale.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            $request = setSessions($request);

            return $next($request);
            
        }catch(Exception $e){
            abort(404);
        }
    }
}

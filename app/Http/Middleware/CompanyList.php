<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyList
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
            $user = auth()->user();
            if ($user->isAdmin() && (url()->current() == 'https://signup.seamlesshiring.com')) {
                return $next($request);
            }else{
                abort(404);
            }
        } catch (\Throwable $th) {
            abort(404);
        }
        
    }
}

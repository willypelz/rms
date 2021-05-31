<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if ( !( $user &&  $user->isAdmin())  ) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => false,
                    'msg' => 'You don\'t have permission to perform this action',
                ], 403);
            }
            return url()->previous(); //TODO change this to 403 when we make a 403 error page
        }
        return $next($request);
    }
}

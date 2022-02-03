<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $excludedRole = null)
    {
        $user = auth()->user();

        if ($user && !$user->roles->where('name', 'admin')->first()) {
            $shouldProceed = false;
            if (is_null($excludedRole)) {
                $shouldProceed = $user->isAdmin();
            } else if ($excludedRole == "interviewer") {
                $shouldProceed = !$user->isInterviewer();
            }
            return ((bool)$shouldProceed) ? $next($request) : $this->isApiRequest($request);
        }

        return $next($request);
    }

    private function isApiRequest($request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => false,
                'msg' => 'You don\'t have permission to perform this action',
            ], 403);
        }
        session()->flash('message', 'You are unauthorised to view this page');
        return back();
    }
}

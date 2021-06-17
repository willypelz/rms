<?php

namespace App\Http\Middleware;

use Closure;

class RequestEmptySpaceTrimmer
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
        $request->merge(array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $request->all()));
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class IsPatient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        abort_if(\Auth::user()->type()!='patient', 403);
        return $next($request);
    }
}

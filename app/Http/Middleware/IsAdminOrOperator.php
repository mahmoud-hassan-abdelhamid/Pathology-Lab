<?php

namespace App\Http\Middleware;

use Closure;

class IsAdminOrOperator
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
        abort_if(\Auth::user()->type()!='admin' && \Auth::user()->type()!='operator', 403);
        return $next($request);
    }
}

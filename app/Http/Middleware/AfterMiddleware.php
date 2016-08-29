<?php

namespace App\Http\Middleware;

use Closure;

class AfterMiddleware
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
        $response=$next($request);
        //retrieve all executed queries
        $queries=\DB::getQueryLog();
        dd($queries);
        return $response;
    }
}

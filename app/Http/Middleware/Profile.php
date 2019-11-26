<?php

namespace NbaNews\Http\Middleware;

use Closure;

class Profile
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

        if(!session('user')){
            \Log::critical('Users address '.$request->ip().' tried to access ProfileController page');
            return abort(404);
        }

        return $next($request);
    }
}

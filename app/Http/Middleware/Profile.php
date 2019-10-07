<?php

namespace App\Http\Middleware;

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
            \Log::critical('User address '.$request->ip().' tried to access Profile page');
            return abort(404);
        }

        return $next($request);
    }
}

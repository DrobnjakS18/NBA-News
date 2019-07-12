<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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

            return abort(404);
        }else{

            if(session('user')->name != 'admin'){
                return abort(404);
            }else {

                return $next($request);
            }
        }


    }
}

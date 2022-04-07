<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use Illuminate\Http\Request;
class Authenticate 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('user.login');
    //     }
    // }

    public function handle(Request $request, Closure $next)
    {

        if(!auth()->guard('web')->check())
        {
            return redirect(route('user.login'));

        }

        if(auth()->guard('web')->user()->status==1) return $next($request); else return redirect(route('user.login'));
    }
}

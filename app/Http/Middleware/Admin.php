<?php

namespace App\Http\Middleware;

use Closure;

//auth library
use Illuminate\Support\Facades\Auth;

class Admin
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
        //added code
        if(Auth::check()){
            //user model has a method called isadmin
            if(Auth::user()->isAdmin()){
                //include Auth class before the  class
                return $next($request);
            }
        }
        return redirect('/');

    }
}

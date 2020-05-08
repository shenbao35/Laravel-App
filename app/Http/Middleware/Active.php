<?php

namespace App\Http\Middleware;

use Closure;

//auth library
use Illuminate\Support\Facades\Auth;

class Active
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
            //user model has a method called isactive
            if(Auth::user()->isActive()){                
                //include Auth class before the  class
                return $next($request);
            }
        }
        return redirect('/');
    }
}

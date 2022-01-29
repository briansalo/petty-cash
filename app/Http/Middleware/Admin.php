<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->email=='briansalo1997@gmail.com' or Auth::user()->email=='admin@gmail.com'){
                    return $next($request);            
        }
        else{
             return redirect('home')->with('message','Error: "Function not available for current user!!!"');
        }


    }
}

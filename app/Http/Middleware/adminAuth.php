<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class adminAuth
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
        if(Auth::user()->nivel == 2)
            return $next($request);
        else   
            return redirect()->route('home.page');
    }

}

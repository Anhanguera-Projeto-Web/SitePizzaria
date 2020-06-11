<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class modAuth
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
        if(Auth::user()->nivel == 1)
            return $next($request);
        else   
            return redirect()->route('home.page');
    }
}

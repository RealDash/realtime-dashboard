<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
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
        // if(Auth::check()){
        //     if(Auth::user()->role()->name == 'admin'){
        //         return $next($request);
        //     }else{
        //         redirect('/dashboard');
        //     }
            
        // }else{
        //     redirect('/login');
        // }
        return $next($request);
    }
}

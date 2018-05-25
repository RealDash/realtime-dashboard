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
        if(Auth::check()){
            $user = Auth::user()->load('role');
            if($user->role->id > 2){
                return redirect('/dashboard');
            }else{
                return $next($request);
            }
            
        }else{
            redirect('/login');
        }
        return $next($request);
    }
}

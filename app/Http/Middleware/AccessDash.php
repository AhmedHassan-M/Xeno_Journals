<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccessDash
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
            if(Auth::user()->privileges == 'A'){
                return $next($request);
            }else{
                return redirect('/');
            }
        }elseif(Auth::guest()){
            return redirect('/admin/login');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AutherAuth
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
            if(Auth::user()->privileges == 'U'){
                return $next($request);
            }else{
                return redirect('/');
            }
        }elseif(Auth::guest()){
            return redirect('/#unauthorized');
        }
    }
}

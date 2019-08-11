<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class UserAuth
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
            if(Auth::user()->privileges == 'A' || Auth::user()->privileges == 'D'){
                return redirect('/admin/dashboard');
            }else{
                return $next($request);
            }
            
        }else{
            return redirect('/#unauthorized');
        }
    }
}

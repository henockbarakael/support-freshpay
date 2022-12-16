<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {

            if( Auth::guard($guard)->check() && Auth::user()->is_user == 1){
                return redirect()->route('admin.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->is_user == 2){
                return redirect()->route('finance.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->is_user == 3){
                return redirect()->route('support_1.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->is_user == 4){
                return redirect()->route('support_2.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->is_user == 5){
                return redirect()->route('support_3.dashboard');
            }
        }

        return $next($request);
    }
}

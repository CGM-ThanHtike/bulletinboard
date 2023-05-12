<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            
            // admin role ==1
            // user role ==2
            if(Auth::user()->role == '1') {
                return $next($request);
            } else {
                return redirect('/home');
                // session()->flash('error', 'Access Denied as you are not Admin');  
                // return redirect('/home')->with('error','Access Denied as you are not Admin');

            }

        } else {
            // return redirect('/login');
            // session()->flash('error', 'Please login first');
            return redirect('/login')->with('error','Please login first');
        }
        

        return $next($request);
    }
}

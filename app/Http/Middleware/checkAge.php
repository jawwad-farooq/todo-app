<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Session;

class checkAge
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
        $path = $request->path();
        if( ($path == 'welcome' || $path == 'all-users') && !Session::get('user')){
            return redirect('/sign-in');
        }
        elseif(($path == 'sign-up' || $path == 'sign-in') && Session::get('user')) {
            return redirect('/welcome');
        }
        return $next($request); 
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;

class checkLogin
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
        if (Auth::check() && Auth::user()->status == config('site.active')) {
            App::setLocale(config('site.langs')[Auth::user()->lang]);
            
            return $next($request);
        } else {
            return redirect( '/login' );
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;

class CheckLogin
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
        if (Auth::check()) {
            if (Auth::user()->status != config('site.active')) {
                Auth::logout();
                alert()->error(__('auth.register'), __('Your account has not been activated!'));

                return redirect('/login');
            }
            App::setLocale(config('site.langs')[Auth::user()->lang]);
            
            return $next($request);
        } else {
            return redirect('/login');
        }
    }
}

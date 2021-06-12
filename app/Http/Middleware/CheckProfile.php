<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckProfile
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
        if(empty(Auth::user()->name) || empty(Auth::user()->country_code) || empty(Auth::user()->phone) || empty(Auth::user()->password) || !Auth::user()->hasAnyRole(['Client', 'Designer'])){
            $request->session()->flash('error',__('Complete your profile to access the portal'));
            return redirect('profile-setup');
        }

        return $next($request);
    }
}

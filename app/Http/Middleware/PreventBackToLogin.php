<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventBackToLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If the user is authenticated, prevent access to the login page
        if (Auth::check() && $request->is('login')) {
            return redirect()->route('home'); // or the route to which logged-in users should be redirected
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $type)
    {
        if (auth()->check() && auth()->user()->user_type === $type) {
            return $next($request); // Allow access if user type matches
        }

        // If user type doesn't match, redirect to home or login with an error
        return redirect('/')->with('error', 'You do not have access to this section.');
    }
}

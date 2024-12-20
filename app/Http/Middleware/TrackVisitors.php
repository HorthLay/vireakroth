<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;

class TrackVisitors
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
        $ipAddress = $request->ip(); // Get the visitor's IP address

        // Check if the IP address is already recorded
        if (!Visitor::where('ip_address', $ipAddress)->exists()) {
            // Create a new record for this visitor
            Visitor::create(['ip_address' => $ipAddress]);
        }

        return $next($request);
    }
}

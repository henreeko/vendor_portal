<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class ProcurementHeadMiddleware
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
        // Check if authenticated and if the user is a procurement head
        if (!Auth::check() || Auth::user()->usertype !== 'procurement_head') {
            // If not, redirect to dashboard with an error message
            return redirect('/dashboard')->with('error', 'Access Denied. You do not have procurement head rights.');
        }

        return $next($request);
    }
}

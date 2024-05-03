<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ProcurementOfficerMiddleware
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
        // Check if authenticated and if the user is a procurement officer
        if (!Auth::check() || Auth::user()->usertype !== 'procurement_officer') {
            // If not, redirect to dashboard or another appropriate page
            return redirect('/dashboard')->with('error', 'Access Denied. You do not have procurement officer rights.');
        }

        return $next($request);
    }
}

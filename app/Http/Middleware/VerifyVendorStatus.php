<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyVendorStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Assuming `is_fully_approved` is a custom attribute you've defined on the User model
        // that checks both the procurement officer and head approvals.
        if ($user && $user->usertype === 'vendor' && $user->is_fully_approved !== true) {
            // Redirect to the "Thank You / Pending Approval" page instead of the home page
            return redirect('/registration/thankyou')->with('message', 'Your account is currently pending approval.');
        }

        return $next($request);
    }
}


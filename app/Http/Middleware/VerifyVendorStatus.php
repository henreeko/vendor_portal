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

        if ($user && $user->usertype === 'vendor') {
            if ($user->status === 'pending') {
                return redirect()->route('registration.thankyou');
            }
        }

        return $next($request);
    }
}

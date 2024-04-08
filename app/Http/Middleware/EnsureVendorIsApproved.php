<?php

// app/Http/Middleware/EnsureVendorIsApproved.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureVendorIsApproved
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if the user is a vendor and if they're approved by both the procurement officer and the procurement head
        if ($user->usertype === 'vendor') {
            if ($user->procurement_officer_approval !== 'approved' || $user->procurement_head_approval !== 'approved') {
                return redirect()->route('registration.thankyou');
            }
        }

        return $next($request);
    }
}

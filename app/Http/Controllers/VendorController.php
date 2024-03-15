<?php

// app/Http/Controllers/VendorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        // Check if the user is a vendor
        $user = Auth::user();
        if ($user && $user->usertype == 'vendor') {
            // Return the vendor dashboard view
            return view('vendor.index');
        }

        // Redirect to the general dashboard if not a vendor
        return redirect()->route('dashboard');
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcurementHeadController extends Controller
{
    public function index()
    {
        // Check if the user is a procurement head
        $user = Auth::user();
        if ($user && $user->usertype == 'procurement_head') {
            // Return the procurement head dashboard view
            return view('procurement_head.index');
        }

        // Redirect to the general dashboard if not a procurement head
        return redirect()->route('dashboard');
    }
}

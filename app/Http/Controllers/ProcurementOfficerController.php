<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcurementOfficerController extends Controller
{
    public function index()
    {
        // Check if the user is a procurement officer
        $user = Auth::user();
        if ($user && $user->usertype == 'procurement_officer') {
            // Return the procurement officer dashboard view
            return view('procurement_officer.index');
        }

        // Redirect to the general dashboard if not a procurement officer
        return redirect()->route('dashboard');
    }
}

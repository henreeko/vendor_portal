<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProcurementOfficerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->usertype == 'procurement_officer') {
            // Fetch vendors with 'reassessment' status
            $vendors = User::where('status', 'reassessment')->paginate(6);
    
            // Pass vendors data to the view
            return view('procurement_officer.index', compact('vendors'));
        }
        
        return view('procurement_officer.index');
    }
}

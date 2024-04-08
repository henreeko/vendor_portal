<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    public function approveVendor($id)
    {
        $vendor = User::findOrFail($id);
        
        // Ensure the vendor was approved by the procurement officer first
        if ($vendor->procurement_officer_approval !== 'approved') {
            return back()->with('error', 'This vendor has not been approved by the procurement officer.');
        }
    
        $vendor->procurement_head_approval = 'approved';
        $vendor->save();
    
        return redirect()->back()->with('success', 'Approved successfully!');
    }
    

    public function pendingVendorsForProcurementHead()
    {
        // Fetch vendors that are approved by the procurement officer but pending approval from the procurement head
        $pendingVendors = User::where('usertype', 'vendor')
                              ->where('procurement_officer_approval', 'approved') // Corrected column name
                              ->where('procurement_head_approval', 'pending') // This line ensures you're getting vendors pending procurement head approval
                              ->get();
    
        return view('procurement_head.pending_vendors', compact('pendingVendors'));
    }
}    
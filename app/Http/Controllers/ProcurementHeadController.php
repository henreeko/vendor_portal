<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ProcurementHeadController extends Controller
{
    public function show($vendorId)
    {
        $vendor = User::findOrFail($vendorId);
        return view('procurement_head.show', compact('vendor'));
    }

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

        // Update the vendor's approval status by the procurement head
        $vendor->procurement_head_approval = 'approved';
        $vendor->approved_by = Auth::id(); // Assuming the approver is the logged-in user
        $vendor->save();

        // Redirect back to the pending vendors page with a success message
        return redirect()->route('procurement_head.vendors.pending')->with('success', 'Vendor approved successfully!');
    }

    public function showPendingVendors()
    {
        // Fetch only vendors who are:
        // - of usertype 'vendor'
        // - approved by a procurement officer
        // - pending approval from a procurement head
        $pendingVendors = User::where('usertype', 'vendor')
                              ->where('procurement_officer_approval', 'approved')
                              ->where('procurement_head_approval', 'pending')
                              ->with('approver') 
                              ->get();

        return view('procurement_head.pending_vendors', compact('pendingVendors'));
    }
    

    public function pendingVendorsForProcurementHead() {
        $pendingVendors = User::where('usertype', 'vendor')
                              ->where('procurement_officer_approval', 'approved')
                              ->where('procurement_head_approval', 'pending')
                              ->with('approver')  // Make sure it is included
                              ->get();
    
        return view('procurement_head.pending_vendors', compact('pendingVendors'));
    }
    
}    
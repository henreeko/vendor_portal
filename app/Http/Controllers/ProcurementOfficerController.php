<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    public function approveVendor(Request $request, $vendorId)
    {
        $vendor = User::findOrFail($vendorId);
        $vendor->procurement_officer_approval = 'approved';
        $vendor->save();
    
        return redirect()->route('procurement_officer.pending_vendors')->with('success', 'Approved successfully!');
    }
    

    public function rejectVendor(Request $request, $vendorId)
    {
        $vendor = User::where('id', $vendorId)->where('usertype', 'vendor')->firstOrFail();
        $vendor->procurement_officer_approval = 'rejected';
        $vendor->save();

        return back()->with('message', 'Vendor rejected.');
    }

    public function showPendingVendors()
    {
        // Example logic to get pending vendors. Adjust the query as needed.
        $pendingVendors = User::where('usertype', 'vendor')
                              ->where('procurement_officer_approval', 'pending')
                              ->get();

        return view('procurement_officer.pending_vendors', compact('pendingVendors'));
    }
}

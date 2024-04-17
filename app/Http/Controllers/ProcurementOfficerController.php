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
        
        // Check if the vendor is not already approved
        if ($vendor->procurement_officer_approval !== 'approved') {
            $vendor->procurement_officer_approval = 'approved';
            $vendor->procurement_officer_approval_date = now(); // Set the current time as the approval date
            $vendor->approved_by = auth()->id(); // Assuming the approver's ID is set by the logged-in user
            $vendor->save();
        
            return redirect()->route('procurement_officer.pending_vendors')->with('success', 'Vendor approved successfully!');
        }
    
        return back()->with('error', 'This vendor has already been approved.');
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

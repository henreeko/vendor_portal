<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        // Fetch users with usertype equal to "vendor"
        $vendors = User::where('usertype', 'vendor')->get();

        // Return the view with vendors data
        return view('admin.vendors.index', compact('vendors'));
    }
    
    // Method to activate a vendor account

    public function activateVendor($id)
    {
        $vendor = User::findOrFail($id);
        // Assuming you want to mark the vendor as approved by both roles
        $vendor->procurement_officer_approval = 'approved';
        $vendor->procurement_head_approval = 'approved';
        $vendor->save();
    
        return redirect()->route('vendors.pending')->with('success', 'Vendor account activated successfully.');
    }

    public function getVendorDetails($vendorId)
    {
        $vendor = User::where('id', $vendorId)->where('usertype', 'vendor')->first();
    
        if (!$vendor) {
            return response()->json(['message' => 'Vendor not found'], 404);
        }
    
        return response()->json($vendor->only(['first_name', 'last_name', 'email', /* other safe attributes */]));

    }

    public function pendingVendorsForProcurementHead()
{
    $pendingVendors = User::where('usertype', 'vendor')
        ->where('procurement_officer_approval', 'approved') // Approved by the procurement officer
        ->where('procurement_head_approval', 'pending') // But pending for the procurement head
        ->get();

    return view('procurement_head.pending_vendors', compact('pendingVendors'));
}

public function getApprovedVendors()
{
    $approvedVendors = User::where('usertype', 'vendor')
                           ->where('procurement_officer_approval', 'approved')
                           ->where('procurement_head_approval', 'approved')
                           ->get(['id', 'first_name', 'last_name', 'email', 'company_name']);
                           
    return response()->json($approvedVendors);
}
}

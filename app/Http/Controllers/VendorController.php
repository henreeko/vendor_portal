<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VendorController extends Controller
{
    public function show($id)
    {
        $vendor = User::findOrFail($id); // Assuming vendors are stored in the User model
        return view('vendors.show', compact('vendor')); // Assuming you have a blade file for showing vendor details
    }

    public function showDetails(User $vendor)
    {
        // Assuming 'vendor' usertype has all necessary fields
        return view('procurement_officer.show_details', compact('vendor'));
    }
    
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
        $vendor->approved_by = Auth::id();
        $vendor->save();
    
        return redirect()->route('vendors.pending')->with('success', 'Vendor account activated successfully.');
    }

    public function getVendorDetails($vendorId)
    {
        $vendor = User::where('id', $vendorId)->where('usertype', 'vendor')->first();
    
        if (!$vendor) {
            return response()->json(['message' => 'Vendor not found'], 404);
        }
    
        return response()->json($vendor->only([
            'first_name', 
            'last_name', 
            'email', 
            'supplier_type', 
            'company_name',
            'office_street',
            'office_barangay',
            'office_zip',
            'office_city',
            'tin_number',
            'website_url',
            'phone_number',
            'billing_representative_first_name',
            'billing_representative_last_name',
            'business_type',
            'telephone_fax_number',
            'products_or_services'
        ]));
    }
    
public function getApprovedVendors()
{
    $approvedVendors = User::where('usertype', 'vendor')
                           ->where('procurement_officer_approval', 'approved')
                           ->where('procurement_head_approval', 'approved')
                           ->get(['id', 'first_name', 'last_name', 'email', 'company_name']);
                           
    return response()->json($approvedVendors);
}

public function documentUpdates()
{
    return view('vendor.document-updates');
}

}

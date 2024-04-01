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

    public function pendingVendors()
    {
        $pendingVendors = User::where('usertype', 'vendor')
            ->where('status', 'pending')
            ->get();

        return view('admin.vendors.pending', compact('pendingVendors'));
    }

    // Method to activate a vendor account
    public function activateVendor(Request $request, $id)
    {
        $vendor = User::findOrFail($id);
        $vendor->status = 'active';
        $vendor->save();

        return redirect()->route('vendors.pending')->with('success', 'Vendor account activated successfully.');
    }
}

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
    
        // Check if the vendor is not already approved by the officer
        if ($vendor->procurement_officer_approval !== 'approved') {
            $vendor->procurement_officer_approval = 'approved';
            $vendor->procurement_officer_approval_date = now(); // Set the current time as the approval date
            $vendor->approved_by_procurement_officer = Auth::id(); // Record the ID of the officer approving
            $vendor->save();
    
            return redirect()->route('procurement_officer.pending_vendors')->with('success', 'Vendor approved successfully!');
        }
    
        return back()->with('error', 'This vendor has already been approved.');
    }
    

    public function showPendingVendors(Request $request)
    {
    $searchQuery = $request->input('search', '');
    $sortBy = $request->input('sortBy', 'id');
    $sortDirection = $request->input('sortDirection', 'asc');

    $pendingVendors = User::with('businessType')
                          ->where('usertype', 'vendor')
                          ->where('procurement_officer_approval', 'pending')
                          ->when($searchQuery, function ($query, $searchQuery) {
                              return $query->where(function($query) use ($searchQuery) {
                                  $query->where('company_name', 'like', '%' . $searchQuery . '%')
                                        ->orWhere('first_name', 'like', '%' . $searchQuery . '%')
                                        ->orWhere('last_name', 'like', '%' . $searchQuery . '%')
                                        ->orWhere('email', 'like', '%' . $searchQuery . '%')
                                        ->orWhere('products_or_services', 'like', '%' . $searchQuery . '%');
                              });
                          })
                          ->orderBy($sortBy, $sortDirection)
                          ->paginate(5);

        return view('procurement_officer.pending_vendors', compact('pendingVendors', 'searchQuery', 'sortBy', 'sortDirection'));
    }
}

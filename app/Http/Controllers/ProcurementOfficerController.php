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

        // Check if the vendor is not already approved or is currently marked for reassessment
        if ($vendor->procurement_officer_approval !== 'approved' || $vendor->status === 'reassessment') {
            $vendor->procurement_officer_approval = 'approved';
            $vendor->procurement_officer_approval_date = now(); // Set the current time as the approval date
            $vendor->approved_by_procurement_officer = Auth::id(); // Record the ID of the officer approving

            // If the vendor was reassessed, reset the status
            if ($vendor->status === 'reassessment') {
                $vendor->status = null; // Or set to another appropriate status
            }

            $vendor->save();

            return redirect()->route('procurement_officer.pending_vendors')->with('success', 'Vendor approved successfully!');
        }

        return back()->with('error', 'This vendor has already been approved or cannot be approved at this stage.');
    }

    public function showReassessment(Request $request)
    {
        $searchQuery = $request->input('search', '');
    
        $vendors = User::where('status', 'reassessment')
                       ->where(function($query) use ($searchQuery) {
                           $query->where('company_name', 'like', '%' . $searchQuery . '%')
                                 ->orWhere('email', 'like', '%' . $searchQuery . '%')
                                 ->orWhere('phone_number', 'like', '%' . $searchQuery . '%')
                                 ->orWhere('products_or_services', 'like', '%' . $searchQuery . '%')
                                 ->orWhere('business_type_id', 'like', '%' . $searchQuery . '%');
                       })
                       ->paginate(6);
    
        return view('procurement_officer.reassessment', compact('vendors'));
    }

    public function reapproveVendor(Request $request, $vendorId)
    {
        $vendor = User::findOrFail($vendorId);
        $vendor->procurement_officer_approval = 'approved';
        $vendor->procurement_officer_approval_date = now(); // Set the current time as the approval date
        $vendor->approved_by_procurement_officer = Auth::id(); // Record the ID of the officer approving
        $vendor->status = 'approved';
        $vendor->save();
    
        return redirect()->back()->with('success', 'Vendor reapproved successfully!');
    }

    public function showPendingVendors(Request $request)
    {
        $searchQuery = $request->input('search', '');
        $searchBy = $request->input('searchBy', 'company_name');
        $sortBy = $request->input('sortBy', 'id');
        $sortDirection = $request->input('sortDirection', 'asc');
        $statusFilter = $request->input('status', null);
    
        $query = User::with('businessType')
                     ->where('usertype', 'vendor')
                     ->where('procurement_officer_approval', 'pending')
                     ->where('status', '!=', 'reassessment')  // Exclude vendors in reassessment status
                     ->when($statusFilter, function ($query, $statusFilter) {
                         return $query->where('status', $statusFilter);
                     })
                     ->when($searchQuery, function ($query) use ($searchQuery, $searchBy) {
                         if ($searchBy == 'business_type') {
                             $query->whereHas('businessType', function ($subQuery) use ($searchQuery) {
                                 return $subQuery->where('name', 'like', '%' . $searchQuery . '%');
                             });
                         } else {
                             $query->where($searchBy, 'like', '%' . $searchQuery . '%');
                         }
                     })
                     ->orderBy($sortBy, $sortDirection);
    
        $pendingVendors = $query->paginate(6);
    
        return view('procurement_officer.pending_vendors', compact('pendingVendors', 'searchQuery', 'searchBy', 'sortBy', 'sortDirection', 'statusFilter'));
    }
}    
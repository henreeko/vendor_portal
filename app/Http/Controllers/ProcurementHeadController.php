<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class ProcurementHeadController extends Controller
{
    public function reassessVendor($id)
    {
        try {
            $vendor = User::findOrFail($id);
            if ($vendor->procurement_officer_approval === 'approved' && $vendor->procurement_head_approval !== 'approved') {
                $vendor->procurement_officer_approval = 'pending';
                $vendor->procurement_officer_approval_date = null;
                $vendor->approved_by_procurement_officer = null;
                $vendor->save();
    
                return redirect()->route('procurement_head.vendors.pending')->with('success', 'Vendor reassessment initiated.');
            } else {
                return redirect()->route('procurement_head.vendors.pending')->with('error', 'Vendor cannot be reassessed at this stage.');
            }
        } catch (\Exception $e) {
            Log::error("Error reassessing vendor: " . $e->getMessage());
            return redirect()->route('procurement_head.vendors.pending')->with('error', 'Error processing your request.');
        }
    }
    


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
        try {
            $vendor = User::findOrFail($id);
            if ($vendor->procurement_officer_approval === 'approved' && $vendor->procurement_head_approval !== 'approved') {
                $vendor->procurement_head_approval = 'approved';
                $vendor->procurement_head_approval_date = now();
                $vendor->approved_by_procurement_head = Auth::id();
                $vendor->save();
    
                return redirect()->route('procurement_head.vendors.pending')->with('success', 'Vendor approved successfully!');
            } else {
                return back()->with('error', 'This vendor has not been approved by the procurement officer.');
            }
        } catch (\Exception $e) {
            Log::error("Error approving vendor: " . $e->getMessage());
            return back()->with('error', 'Error processing your request.');
        }
    }
          
    

    public function showPendingVendors()
    {
        $pendingVendors = User::with(['businessType', 'procurementOfficerApprover'])
                                ->where('usertype', 'vendor')
                                ->where('procurement_officer_approval', 'approved')
                                ->where('procurement_head_approval', 'pending')
                                ->with(['procurementOfficerApprover', 'businessType'])
                                ->get();
    
        return view('procurement_head.pending_vendors', compact('pendingVendors'));
    }
    
}
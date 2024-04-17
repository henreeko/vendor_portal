<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalVendors = User::where('usertype', 'vendor')->count();
        $approvedVendors = User::where('usertype', 'vendor')->where('procurement_officer_approval', 'approved')->where('procurement_head_approval', 'approved')->count();
        $pendingVendors = User::where('usertype', 'vendor')->where(function($query) {
            $query->where('procurement_officer_approval', 'pending')
                  ->orWhere('procurement_head_approval', 'pending');
        })->count();
        $rejectedVendors = User::where('usertype', 'vendor')->where(function($query) {
            $query->where('procurement_officer_approval', 'rejected')
                  ->orWhere('procurement_head_approval', 'rejected');
        })->count();
    
        return view('admin.dashboard', compact('totalUsers', 'totalVendors', 'approvedVendors', 'pendingVendors', 'rejectedVendors'));
    }
    
}

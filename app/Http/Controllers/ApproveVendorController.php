<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApproveVendorController extends Controller
{
    public function show(User $user)
    {
        return view('admin.vendors.approve_vendor', compact('user'));
    }
}

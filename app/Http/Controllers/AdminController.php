<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $user = Auth::user();
        if ($user && $user->usertype == 'admin') {
            return view('admin.index', compact('totalUsers'));
        }

        return redirect()->route('dashboard');
    }
}

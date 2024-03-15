<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    // Calculate total user count
    $totalUsers = User::count();

    // Pass the total user count to the view
    return view('admin.index', compact('totalUsers'));
}
    public function getTotalUsersCount()
{
    $totalUsers = User::count();
    return response()->json(['count' => $totalUsers]);
}
}
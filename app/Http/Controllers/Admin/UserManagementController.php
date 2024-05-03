<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function authorizeUser($user, $ability)
    {
        return true; 
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'usertype' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
    
        // Update user data except password
        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'usertype' => $validatedData['usertype'],
        ]);
    
        // Update the password if provided
        if (!empty($validatedData['password'])) {
            $user->update([
                'password' => bcrypt($validatedData['password']),
            ]);
        }
    
        // Redirect back to the user list with a success message
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function index(Request $request)
{
    $search = $request->input('search');
    $userType = $request->input('usertype');
    $created_at = $request->input('created_at');
    $sort = $request->input('sort', 'created_at');
    $direction = $request->input('direction', 'desc');

    $users = User::query();

    if ($search) {
        $users = $users->where(function ($query) use ($search) {
            $query->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        });
    }

    if ($userType) {
        $users = $users->where('usertype', $userType);
    }

    if ($created_at) {
        $users = $users->whereDate('created_at', '=', $created_at);
    }

    $users = $users->orderBy($sort, $direction)->paginate(10)->withQueryString();

    return view('admin.users.index', compact('users'));
}

    

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'usertype' => ['required', 'string'],
        ]);

        // Create the new user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usertype' => $request->usertype,
        ]);

        // Redirect back to the user list with a success message
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete(); // Soft delete the user
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function deletedUsers()
    {
        $deletedUsers = User::onlyTrashed()->get();
        return view('admin.users.deleted', compact('deletedUsers'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.deleted')->with('success', 'User restored successfully.');
    }

    public function verifyPassword(Request $request)
    {
        $request->validate(['password' => 'required']);

        if (Hash::check($request->password, Auth::user()->password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 422);
        }
    }

    public function forceDelete(Request $request, $userId)
    {
        $request->validate(['password' => 'required']);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'The admin password is incorrect.']);
        }

        $user = User::withTrashed()->findOrFail($userId);
        $user->forceDelete();

        return redirect()->route('admin.users.deleted')->with('success', 'User permanently deleted.');
    }
    
    
}

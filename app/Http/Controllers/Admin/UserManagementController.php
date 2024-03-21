<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'usertype' => ['required', 'string'],
    ]);

    // Update the user with the validated data
    $user->update([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'usertype' => $request->input('usertype'),
    ]);

    // Redirect back to the user list with a success message
    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    // Method to display the list of users
    public function index(Request $request)
{
    $search = $request->get('search');
    $sort = $request->get('sort', 'created_at');
    $direction = $request->get('direction', 'desc');
    $userType = $request->get('usertype');

    $query = User::query();

    // Include soft-deleted users if requested
    if ($request->has('withTrashed')) {
        $query->withTrashed();
    }

    $users = $query->when($search, function ($query, $search) {
        return $query->where('first_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
    })
    ->when($userType, function ($query, $userType) {
        return $query->where('usertype', $userType);
    })
    ->orderBy($sort, $direction)
    ->paginate(10);

    return view('admin.users.index', compact('users', 'sort', 'direction'));
}
    
    // Method to show the user creation form
    public function create()
    {
        return view('admin.users.create');
    }

    // Method to store a new user
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

    // Method to delete a user
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
}

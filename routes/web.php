<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HistoryLogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProcurementOfficerController;
use App\Http\Controllers\ProcurementHeadController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');  
})->middleware('preventBackHistory');

// Protected dashboard route with auth middleware
Route::middleware(['auth', 'verified','preventBackHistory'])->group(function () {
    Route::get('/dashboard', function () {
        $usertype = auth()->user()->usertype;

        if ($usertype == 'admin') {
            return view('admin.index');
        } elseif ($usertype == 'procurement_officer') {
            return view('procurement_officer.index');
        } elseif ($usertype == 'procurement_head') {
            return view('procurement_head.index');
        } elseif ($usertype == 'vendor') {
            return view('vendor.index');
        } else {
            return redirect()->route('dashboard');
        }
    })->name('dashboard');

    // Other profile-related routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/admin/history_logs', [HistoryLogController::class, 'index'])->name('admin.history_logs.index');
});

Route::middleware(['auth', 'verified', 'can:admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserManagementController::class);
});

// Route to display the list of users
Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
// Route to show the user creation form
Route::get('/admin/users/create', [UserManagementController::class, 'create'])->name('admin.users.create');



// Route to store a new user
Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');
// Route to show the user edit form
Route::get('/admin/users/{user}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
// Route to update a user
Route::put('/admin/users/{user}', [UserManagementController::class, 'update'])->name('admin.users.update');
// Route to delete a user
Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
// Route for soft deletes
Route::get('admin/users/deleted', [UserManagementController::class, 'deletedUsers'])->name('admin.users.deleted');

Route::get('/admin/users/{user}', [UserManagementController::class, 'show'])->name('admin.users.show');

// For admin dash
Route::get('/admin/users/count', [UserController::class, 'getTotalUsersCount'])->name('admin.users.count');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

require __DIR__.'/auth.php';

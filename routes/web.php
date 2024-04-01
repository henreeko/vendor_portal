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
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ThankYouController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('preventBackHistory');

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
    })->name('dashboard')->middleware(['auth', 'verified', 'verify.vendor.status']);

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



Route::middleware(['auth'])->group(function () {
Route::post('/users', [UserManagementController::class, 'store'])->name('admin.users.store');
// Route to delete a user
Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
// Route for soft deletes
Route::get('/users/deleted', [UserManagementController::class, 'deletedUsers'])->name('admin.users.deleted');
// Route to show a user
Route::get('/users/{user}', [UserManagementController::class, 'show'])->name('admin.users.show');
// Route to edit a user
Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
// Route to update a user
Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('admin.users.update');
});

// Registration Routes
Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register/first-store', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'storeFirstStep'])->name('register.first-store');
Route::get('/register/second', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'showSecondStepForm'])->name('register.second');
Route::post('register/second-store', [RegisteredUserController::class, 'storeSecondStep'])->name('register.second-store');


// For admin dash
Route::get('/admin/users/count', [UserController::class, 'getTotalUsersCount'])->name('admin.users.count');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

// For Activation
Route::middleware(['auth'])->group(function () {
Route::get('admin/vendors', [VendorController::class, 'allVendors'])->name('admin.vendors.index');
Route::get('/admin/vendors', [VendorController::class, 'index'])->name('vendor.index');
Route::get('/vendors/pending', [VendorController::class, 'pendingVendors'])->name('vendors.pending');
Route::post('/vendors/{id}/activate', [VendorController::class, 'activateVendor'])->name('vendors.activate');
});
Route::get('/registration/thankyou', [ThankYouController::class, 'show'])->name('registration.thankyou');

require __DIR__.'/auth.php';
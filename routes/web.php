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
use App\Http\Livewire\BusinessTypesManager;
use App\Http\Livewire\Admin\DeletedUsers;


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

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/history_logs', function () {
        if (!in_array(auth()->user()->usertype, ['admin'])) {
            abort(403);
        }
        return view('admin.history_logs.index');
    })->name('admin.history_logs.index');
});

Route::middleware(['auth', 'verified', 'can:admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserManagementController::class);
});

// Registration Routes
Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register/first-store', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'storeFirstStep'])->name('register.first-store');
Route::get('/register/second', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'showSecondStepForm'])->name('register.second');
Route::post('register/second-store', [RegisteredUserController::class, 'storeSecondStep'])->name('register.second-store');
Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');

// For Activation
Route::middleware(['auth', 'verified', 'preventBackHistory'])->group(function () {
    Route::get('/vendors/pending', [VendorController::class, 'pendingVendors'])->name('vendors.pending');
    Route::post('/vendors/{id}/activate', [VendorController::class, 'activateVendor'])->name('vendors.activate');
    Route::get('/vendors/details/{vendorId}', [VendorController::class, 'getVendorDetails'])->name('vendors.details');
})->middleware(['verify.vendor.status']);

// For Registration
Route::get('/registration/thankyou', [ThankYouController::class, 'show'])->name('registration.thankyou');
Route::get('/registration-pending', function () {
    return view('auth.registration_pending');
})->name('registration.pending');

// For Procurement Head
    Route::get('/admin/vendors/pending', [VendorController::class, 'pendingVendorsForProcurementHead'])->name('admin.vendors.pending');
    Route::post('/procurement-head/approve-vendor/{id}', [ProcurementHeadController::class, 'approveVendor']);
    Route::post('/procurement-head/approve-vendor/{id}', [ProcurementHeadController::class, 'approveVendor'])->name('procurement_head.approve');

    Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/procurement-head/vendors/pending', [ProcurementHeadController::class, 'pendingVendorsForProcurementHead'])
    //     ->name('procurement_head.vendors.pending');
    Route::get('/procurement-head/pending-vendors', [ProcurementHeadController::class, 'showPendingVendors'])->name('procurement_head.vendors.pending');
    Route::get('/procurement_head/vendors/{vendor}', [ProcurementHeadController::class, 'show'])->name('procurement_head.vendors.show');
});

// For Procurement Officer
    Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/procurement-officer/pending-vendors', [ProcurementOfficerController::class, 'showPendingVendors'])
    ->name('procurement_officer.pending_vendors');
    Route::get('/vendors/{vendor}/details', [VendorController::class, 'showDetails'])
     ->name('vendors.show_details');



// Route to approve a vendor by procurement officer
    Route::post('/procurement-officer/vendors/approve/{vendorId}', [ProcurementOfficerController::class, 'approveVendor'])
    ->name('procurement_officer.approve_vendor');

// Not Approved
Route::get('/vendor/pending-approval', function () {
    return view('vendor.pending_approval');
    })->name('vendor.pendingApproval');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/vendors', function () {
        if (!in_array(auth()->user()->usertype, ['admin', 'procurement_officer'])) {
            abort(403); // Forbidden access
        }
        return view('admin.vendors.index');
    })->name('admin.vendors.index');
});

// SECURED ADMIN ROUTE
Route::middleware(['auth', 'admin.access'])->group(function () {
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserManagementController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserManagementController::class, 'store'])->name('admin.users.store');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/users/{user}', [UserManagementController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('admin.users.update');
    Route::post('/users/{user}/force-delete', [UserManagementController::class, 'forceDelete'])->name('admin.users.forceDelete');
    Route::post('/users/{id}/restore', [UserManagementController::class, 'restore'])->name('admin.users.restore');
    Route::post('/password/verify', [UserManagementController::class, 'verifyPassword'])->name('admin.password.verify');
    Route::get('/admin/deleted-users', DeletedUsers::class)->name('admin.deleted-users');

    Route::get('/admin/vendors', function () {
        return view('admin.users.index');
    })->name('admin.users.index');
});


// Routes for both Admin and Procurement Officers
Route::middleware(['auth', 'admin.procurement.access'])->group(function () {
    Route::get('/admin/vendors', function () {
        return view('admin.vendors.index');
    })->name('admin.vendors.index');

    // Add your new route here
    Route::get('/admin/business-types', BusinessTypesManager::class)->name('admin.business-types.index');
});

require __DIR__.'/auth.php';
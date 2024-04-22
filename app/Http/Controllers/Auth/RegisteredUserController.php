<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\BusinessType;
use Illuminate\Support\Facades\Storage;
use App\Models\VendorDocument;

class RegisteredUserController extends Controller
{

    // Show the first step of the registration form
    public function create()
    {
        return view('auth.register_first');
    }

    // Store the first step data in the session
    public function storeFirstStep(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Add any other user-specific validation rules here
        ]);

        $request->session()->put('register_first_step', $validatedData);

        return redirect()->route('register.second');
    }

    // Show the second step of the registration form
    public function showSecondStepForm(Request $request)
    {
        if (!$request->session()->has('register_first_step')) {
            return redirect()->route('register')->with('error', 'Please complete the registration from the beginning.');
        }
    
        $data = $request->session()->get('register_first_step');
        $businessTypes = BusinessType::all(); // Fetch all business types
    
        return view('auth.register_second', compact('data', 'businessTypes'));
    }

    // Store the second step data, complete registration, and clear session
    public function storeSecondStep(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_type' => ['required', 'string'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'office_street' => ['nullable', 'string', 'max:255'],
            'office_barangay' => ['nullable', 'string', 'max:255'],
            'office_zip' => ['nullable', 'string', 'max:255'],
            'office_city' => ['nullable', 'string', 'max:255'],
            'tin_number' => ['required', 'numeric', 'digits:14', 'unique:users'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:11'],
            'billing_representative_first_name' => ['nullable', 'string', 'max:255'],
            'billing_representative_last_name' => ['nullable', 'string', 'max:255'],
            'business_type_id' => ['required', 'exists:business_types,id'],
            'products_or_services' => ['nullable', 'string'],
            'telephone_fax_number' => ['nullable', 'numeric'],
            'bir_2303' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'bir_2303_expiry' => 'required|date',
            'sec' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sec_expiry' => 'required|date',
            'mayors_permit' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'mayors_permit_expiry' => 'required|date',
        ]);

        $firstStepData = $request->session()->get('register_first_step');

        if (!is_array($firstStepData)) {
        return redirect()->route('register')->with('error', 'An error occurred. Please start the registration process again.');
        }

        $userData = array_merge($firstStepData, $validatedData);

        $user = User::create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'usertype' => 'vendor', // Assuming all registrations through this form are vendors
            'supplier_type' => $userData['supplier_type'],
            'company_name' => $userData['company_name'],
            'office_street' => $userData['office_street'],
            'office_barangay' => $userData['office_barangay'],
            'office_zip' => $userData['office_zip'],
            'office_city' => $userData['office_city'],
            'tin_number' => $userData['tin_number'],
            'website_url' => $userData['website_url'],
            'phone_number' => $userData['phone_number'],
            'billing_representative_first_name' => $userData['billing_representative_first_name'],
            'billing_representative_last_name' => $userData['billing_representative_last_name'],
            'business_type_id' => $validatedData['business_type_id'],
            'products_or_services' => $userData['products_or_services'],
            'telephone_fax_number' => $userData['telephone_fax_number'],
            'procurement_officer_approval' => 'pending',
            'procurement_head_approval' => 'pending',
        ]);

        if (!$user) {
            return redirect()->back()->with('error', 'Failed to create user.');
        }

    // Handle document upload
    $documents = [
        'bir_2303' => $request->bir_2303_expiry,
        'sec' => $request->sec_expiry,
        'mayors_permit' => $request->mayors_permit_expiry,
    ];

    foreach ($documents as $type => $expiry) {
        if ($request->hasFile($type)) {
            $path = $request->file($type)->store('documents', 'public');
            $user->documents()->create([
                'document_type' => $type,
                'path' => $path,
                'name' => $request->file($type)->getClientOriginalName(), // Adding the original file name
                'expiry_date' => $request[$type . '_expiry'],
            ]);
        }
    }
        $request->session()->forget('register_first_step');

        // Redirect to a page informing the user their registration is pending approval
        return redirect()->route('welcome')->with('registration_success', 'Your account has been created and is pending approval.');
    }
}

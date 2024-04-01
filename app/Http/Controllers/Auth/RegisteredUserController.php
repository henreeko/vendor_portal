<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    // Method to show the first step of registration form
    public function create()
    {
        return view('auth.register_first');
    }

    // Method to store the first step data
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

    // Method to show the second step of registration form
    public function showSecondStepForm(Request $request)
    {
        $data = $request->session()->get('register_first_step');

        return view('auth.register_second', compact('data'));
    }

    // Method to store the second step data and complete registration
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
            'business_type' => ['nullable', 'string', 'max:255'],
            'products_or_services' => ['nullable', 'string'],
            'telephone_fax_number' => ['nullable', 'numeric'],
        ]);

        $firstStepData = $request->session()->get('register_first_step');

        $userData = array_merge($firstStepData, $validatedData);

        $user = User::create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'usertype' => 'vendor', // Set usertype to 'vendor' for vendor registrations
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
            'business_type' => $userData['business_type'],
            'products_or_services' => $userData['products_or_services'],
            'telephone_fax_number' => $userData['telephone_fax_number'],
            'status' => 'pending',
        ]);

        $request->session()->forget('register_first_step');

        return redirect()->route('welcome')->with('registration_success', true);
    }
}

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
use Illuminate\Support\Facades\Session;

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
    try {
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\'\-]+$/'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\'\-]+$/'],    
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Logic to handle storing the user or proceeding with registration
        $request->session()->put('register_first_step', $validatedData);
        return response()->json(['status' => 'success']);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // If validation fails, return errors in JSON format
        return response()->json([
            'status' => 'error',
            'errors' => $e->validator->getMessageBag()->toArray()
        ], 422);
    }
}


    // Show the second step of the registration form
    public function showSecondStepForm(Request $request)
    {
        if (!$request->session()->has('register_first_step')) {
            return redirect()->route('register')->with('error', 'Please complete the registration from the beginning.');
        }
    
        $data = $request->session()->get('register_first_step');
        // Fetch only non-custom business types
        $businessTypes = BusinessType::where('is_custom', false)->get(); // Ensure only non-custom types are fetched
    
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
            'office_zip' => ['required', 'numeric', 'digits:4'],
            'office_city' => ['nullable', 'string', 'max:255'],
            'tin_number' => ['required', 'numeric', 'digits:12', 'unique:users'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:11'],
            'billing_representative_first_name' => ['nullable', 'string', 'max:255'],
            'billing_representative_last_name' => ['nullable', 'string', 'max:255'],
            'br_email' => ['nullable', 'email', 'max:255'],
            'br_phone_number' => ['nullable', 'string', 'max:11'],
            'business_type_id' => [
                'required', 
                function($attribute, $value, $fail) use ($request) {
                    if ($value == 'other' && !$request->input('other_business_type')) {
                        $fail('The other business type field is required when "Other" is selected.');
                    }
                }
            ],
            'other_business_type' => 'sometimes|required|string|max:255',
            'products_or_services' => ['nullable', 'string'],
            'telephone_fax_number' => ['nullable', 'numeric'],
            'bir_2303' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'bir_2303_expiry' => 'required|date',
            'sec' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sec_registration_date' => 'required|date',
            'mayors_permit' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sample_or' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sample_invoice' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $firstStepData = $request->session()->get('register_first_step');
        if (!is_array($firstStepData)) {
            return redirect()->route('register')->with('error', 'An error occurred. Please start the registration process again.');
        }
    
        $businessTypeId = $validatedData['business_type_id'];
        if ($businessTypeId === 'other') {
            $businessType = BusinessType::firstOrCreate(
                ['name' => $request->input('other_business_type')],
                ['is_custom' => true]
            );
            $businessTypeId = $businessType->id;
        }
    
        $userData = array_merge($firstStepData, $validatedData, ['business_type_id' => $businessTypeId]);

        $user = User::create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'usertype' => 'vendor',
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
            'br_email' => $userData['br_email'],
            'br_phone_number' => $userData['br_phone_number'],
            'business_type_id' => $businessTypeId,
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
            'bir_2303' => [
                'expiry' => $request->bir_2303_expiry,  // This is directly submitted by the user.
                'file' => $request->file('bir_2303')
            ],
            'sec' => [
                'registration_date' => $request->sec_registration_date,  // This replaces the expiry with a registration date.
                'file' => $request->file('sec')
            ],
            'mayors_permit' => [
                'expiry' => new \DateTime('this year December 31'),  // Automatically set to expire on December 31st of the current year.
                'file' => $request->file('mayors_permit')
            ],
            'sample_or' => [
                'file' => $request->file('sample_or')
            ],
            'sample_invoice' => [
                'file' => $request->file('sample_invoice')
            ]
        ];

        foreach ($documents as $type => $details) {
            // Check if the 'file' key exists in $details and if it's not empty
            if (isset($details['file']) && $details['file']->isValid()) {
                $path = $details['file']->store('documents', 'public');
                $user->documents()->create([
                    'document_type' => $type,
                    'path' => $path,
                    'name' => $details['file']->getClientOriginalName(),
                    'expiry_date' => $details['expiry'] ?? null,
                    'registration_date' => $details['registration_date'] ?? null,
                ]);
            }
        }        
        //End of doc upload

        $request->session()->forget('register_first_step');

        // Redirect to a page informing the user their registration is pending approval
        return redirect()->route('welcome')->with('registration_success', 'Your account has been created and is pending approval.');
    }


    
}
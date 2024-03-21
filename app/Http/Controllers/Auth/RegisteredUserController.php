<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register_first');
    }

    public function storeFirstStep(Request $request)
{
    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Check if the password and password confirmation match
    if ($request->password !== $request->password_confirmation) {
        return redirect()->back()->withErrors(['password' => 'The password confirmation does not match.'])->withInput();
    }

    // Store first step data in session
    $request->session()->put('first_step_data', $request->all());

    return redirect()->route('register.second');
}

    public function createSecondStep(Request $request)
    {
        // Check if the first step data is stored in the session
        if ($request->session()->has('first_step_data')) {
            $firstStepData = $request->session()->get('first_step_data');
            return view('auth.register_second', compact('firstStepData'));
        } elseif ($request->user() && $request->user()->hasCompletedFirstStep()) {
            // Check if the user has already completed the first step
            return view('auth.register_second', ['firstStepData' => $request->user()->getFirstStepData()]);
        } else {
            // Redirect to the first step if data is missing and user hasn't completed first step
            return redirect()->route('register.first');
        }
    }

    public function storeSecondStep(Request $request)
    {
        $request->validate([
            'supplier_type' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'office_street' => ['nullable', 'string', 'max:255'],
            'office_barangay' => ['nullable', 'string', 'max:255'],
            'office_zip' => ['nullable', 'string', 'max:255'],
            'office_city' => ['nullable', 'string', 'max:255'],
            'tin_number' => ['required', 'numeric', 'digits:14', 'unique:users'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'numeric', 'digits:11', 'unique:users'],
            'billing_representative_first_name' => ['nullable', 'string', 'max:255'],
            'billing_representative_last_name' => ['nullable', 'string', 'max:255'],
            'business_type' => ['nullable', 'string', 'max:255'],
            'products_or_services' => ['nullable', 'string'],
            'telephone_fax_number' => ['nullable', 'numeric', 'unique:users'],
        ]);

        if ($request->session()->has('first_step_data')) {
            $mergedData = array_merge($request->session()->get('first_step_data'), $request->except('_token'));

            $user = User::create([
                'first_name' => $mergedData['first_name'],
                'last_name' => $mergedData['last_name'],
                'email' => $mergedData['email'],
                'password' => Hash::make($mergedData['password']),
                // Add other fields from $mergedData here
                'supplier_type' => $mergedData['supplier_type'],
                'company_name' => $mergedData['company_name'],
                'office_street' => $mergedData['office_street'],
                'office_barangay' => $mergedData['office_barangay'],
                'office_zip' => $mergedData['office_zip'],
                'office_city' => $mergedData['office_city'],
                'tin_number' => $mergedData['tin_number'],
                'website_url' => $mergedData['website_url'],
                'phone_number' => $mergedData['phone_number'],
                'billing_representative_first_name' => $mergedData['billing_representative_first_name'],
                'billing_representative_last_name' => $mergedData['billing_representative_last_name'],
                'business_type' => $mergedData['business_type'],
                'products_or_services' => $mergedData['products_or_services'],
                'telephone_fax_number' => $mergedData['telephone_fax_number'],
            ]);

            $request->session()->forget('first_step_data');

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('login');
        }

        return redirect()->route('register.first');
    }
}

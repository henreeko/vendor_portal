{{-- resources/views/auth/register_second.blade.php --}}

<x-guest-layout>
    <form method="POST" action="{{ route('register.second-store') }}" class="space-y-6">
        @csrf

        <h5 class="text-xl font-bold dark:text-white text-center">Company Details</h5>

        <div class="flex justify-center items-center mt-8 space-x-4">
            <span class="flex w-3 h-3 me-3 bg-gray-200 rounded-full"></span>
            <span class="flex w-3 h-3 me-3 bg-red-500 rounded-full"></span>
        </div>
        
        <!-- Supplier Type -->
        <div class="mb-6">
            <label for="supplier_type" class="block text-sm font-medium text-gray-700">Supplier Type</label>
            <select id="supplier_type" name="supplier_type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" required>
                <option value="" disabled selected>Select</option>
                <option value="local" @if(old('supplier_type') == 'local') selected @endif>Local Supplier</option>
                <option value="foreign" @if(old('supplier_type') == 'foreign') selected @endif>Foreign Supplier</option>
            </select>
            <x-input-error :messages="$errors->get('supplier_type')" />
        </div>

        <!-- Company Name -->
        <div class="mb-6">
            <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
            <x-text-input id="company_name" class="block w-full mt-1" type="text" name="company_name" :value="old('company_name')" required />
            <x-input-error :messages="$errors->get('company_name')" />
        </div>

        <!-- Office Address -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Office Address</label>
            <div class="grid grid-cols-2 gap-4 mt-1">
                <x-text-input id="office_address_street" class="block w-full" type="text" name="office_street" :value="old('office_street')" placeholder="Street" required />
                <x-text-input id="office_address_barangay" class="block w-full" type="text" name="office_barangay" :value="old('office_barangay')" placeholder="Barangay" required />
                <x-text-input id="office_address_zip" class="block w-full" type="text" name="office_zip" :value="old('office_zip')" placeholder="Zip Code" required />
                <x-text-input id="office_address_city" class="block w-full" type="text" name="office_city" :value="old('office_city')" placeholder="City" required />
            </div>
        </div>

        <!-- TIN Number -->
        <div class="mb-6">
            <label for="tin_number" class="block text-sm font-medium text-gray-700">TIN Number</label>
            <x-text-input id="tin_number" class="block w-full mt-1" type="text" name="tin_number" :value="old('tin_number')" required maxlength="14" />
            <x-input-error :messages="$errors->get('tin_number')" />
        </div>

        <!-- Website URL -->
        <div class="mb-6">
            <label for="website_url" class="block text-sm font-medium text-gray-700">Website URL</label>
            <x-text-input id="website_url" class="block w-full mt-1" type="text" name="website_url" :value="old('website_url')" placeholder="Type 'Not Applicable' if no website" />
            <x-input-error :messages="$errors->get('website_url')" />
        </div>

        <!-- Phone Number (Philippine format) -->
        <div class="mb-6">
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <x-text-input id="phone_number" class="block w-full mt-1" type="tel" name="phone_number" :value="old('phone_number')" placeholder="e.g., 09123456789" pattern="[0-9]{11}" maxlength="11" required />
            <x-input-error :messages="$errors->get('phone_number')" />
        </div>

        <!-- Billing Representative -->
        <div class="mb-6">
            <label for="billing_representative_first_name" class="block text-sm font-medium text-gray-700">Billing Representative</label>
            <div class="flex">
                <x-text-input id="billing_representative_first_name" class="block w-full mr-2" type="text" name="billing_representative_first_name" :value="old('billing_representative_first_name')" placeholder="First Name" required />
                <x-text-input id="billing_representative_last_name" class="block w-full ml-2" type="text" name="billing_representative_last_name" :value="old('billing_representative_last_name')" placeholder="Last Name" required />
            </div>
            <x-input-error :messages="$errors->get('billing_representative_first_name')" />
            <x-input-error :messages="$errors->get('billing_representative_last_name')" />
        </div>

        <!-- Telephone/Fax Number -->
        <div class="mb-6">
            <label for="telephone_fax_number" class="block text-sm font-medium text-gray-700">Telephone/Fax Number</label>
            <x-text-input id="telephone_fax_number" class="block w-full mt-1" type="text" name="telephone_fax_number" :value="old('telephone_fax_number')" />
            <x-input-error :messages="$errors->get('telephone_fax_number')" />
        </div>

        <!-- Business Type -->
        <div class="mb-6">
            <label for="business_type" class="block text-sm font-medium text-gray-700">Business Type</label>
            <select id="business_type" name="business_type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                <option value="Software">Software services</option>
                <option value="Training">Training services</option>
                <option value="Event planning">Event planning services</option>
                <option value="Consulting">Consulting services</option>
                <option value="Marketing">Marketing services</option>
                <option value="Waste management">Waste management services</option>
                <option value="Construction">Construction services</option>
                <option value="Legal services">Legal services</option>
                <option value="Health and wellness">Health and wellness services</option>
                <option value="Insurance">Insurance services</option>
                <option value="Security">Security services</option>
                <option value="Travel">Travel services</option>
                <option value="Research">Research services</option>
                <option value="Design">Design services</option>
                <option value="Finance">Finance services</option>
                <option value="Delivery">Delivery services</option>
                <option value="Real estate">Real estate services</option>
                <option value="Child care">Child care services</option>
                <option value="Utilities">Utilities</option>
                <option value="Printing">Printing services</option>
                <option value="Personal">Personal services</option>
                <option value="Landscaping">Landscaping</option>
                <option value="Pest extermination">Pest extermination services</option>
                <option value="Maintenance">Maintenance services</option>
                <option value="Tech support">Tech support services</option>
                <option value="Bookkeeping">Bookkeeping services</option>
                <option value="Video and photography">Video and photography services</option>
                <option value="Translation">Translation services</option>
                <option value="Parking">Parking services</option>
                <option value="Public relations">Public relations services</option>
            </select>
            <x-input-error :messages="$errors->get('business_type')" />
        </div>

         <!-- Products or Services -->
         <div class="mb-6">
            <label for="products_or_services" class="block text-sm font-medium text-gray-700">Products or Services</label>
            <textarea id="products_or_services" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" name="products_or_services" rows="4" placeholder="Enter products or services separated by commas">{{ old('products_or_services') }}</textarea>
            <x-input-error :messages="$errors->get('products_or_services')" />
        </div>

                <!-- Terms and Conditions Checkbox -->
                <div class="mb-6">
                    <label for="terms_and_conditions" class="flex items-center">
                        <input id="terms_and_conditions" type="checkbox" name="terms_and_conditions" class="form-checkbox rounded-md text-red-500 border-gray-400 focus:ring-2 focus:ring-red-500" required>
                        <span class="ml-2 text-sm text-gray-600">{{ __('I agree to the :terms', ['terms' => 'Terms and Conditions']) }}</span>
                    </label>
                    <x-input-error :messages="$errors->get('terms_and_conditions')" />
                </div>
                
        <!-- Action Buttons -->
        <div class="flex justify-between">
            <x-primary-button type="button" onclick="goToPreviousStep()">
                {{ __('Back') }}
            </x-primary-button>

            <!-- Submit Button -->
            <x-primary-button type="submit">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function goToPreviousStep() {
            window.history.back();
        }
    </script>
</x-guest-layout>

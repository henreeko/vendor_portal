{{-- resources/views/auth/register_second.blade.php --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-guest-layout>
    <form method="POST" action="{{ route('register.second-store') }}" enctype="multipart/form-data"  class="space-y-6">
        @csrf
        <h5 class="text-xl font-bold dark:text-white text-center">Company Details</h5>
        <p class="text-xs dark:text-white text-center">Second Step</p>
        <div class="flex justify-center items-center mt-8 space-x-4">
            <span class="flex w-3 h-3 me-3 bg-green-500 rounded-full"></span>
            <span class="flex w-3 h-3 me-3 bg-red-500 rounded-full"></span>
        </div>
        
        <!-- Supplier Type -->
        <div class="mb-6">
            <label for="supplier_type" class="block text-sm font-medium text-gray-700">Supplier Type<span class="text-red-500">*</label>
            <select id="supplier_type" name="supplier_type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" required>
                <option value="" disabled selected>Select</option>
                <option value="local" @if(old('supplier_type') == 'local') selected @endif>Local Supplier</option>
                <option value="foreign" @if(old('supplier_type') == 'foreign') selected @endif>Foreign Supplier</option>
            </select>
            <x-input-error :messages="$errors->get('supplier_type')" />
        </div>

        <!-- Company Name -->
        <div class="mb-6">
            <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name<span class="text-red-500">*</label>
            <x-text-input id="company_name" class="block w-full mt-1" type="text" name="company_name" :value="old('company_name')" required />
            <x-input-error :messages="$errors->get('company_name')" />
        </div>

        <!-- Office Address -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Office Address<span class="text-red-500">*</label>
            <div class="grid grid-cols-2 gap-4 mt-1">
                <x-text-input id="office_address_street" class="block w-full" type="text" name="office_street" :value="old('office_street')" placeholder="Street" required />
                <x-text-input id="office_address_barangay" class="block w-full" type="text" name="office_barangay" :value="old('office_barangay')" placeholder="Barangay" />
                <x-text-input id="office_address_zip" class="block w-full" type="text" name="office_zip" :value="old('office_zip')" placeholder="Zip Code" required />
                <x-text-input id="office_address_city" class="block w-full" type="text" name="office_city" :value="old('office_city')" placeholder="City" required />
            </div>
        </div>

        <!-- TIN Number -->
        <div class="mb-6">
            <label for="tin_number" class="block text-sm font-medium text-gray-700">TIN Number<span class="text-red-500">*</label>
            <x-text-input id="tin_number" class="block w-full mt-1" type="text" name="tin_number" :value="old('tin_number')" required maxlength="14" />
            <x-input-error :messages="$errors->get('tin_number')" />
        </div>

        <!-- Website URL -->
        <div class="mb-6">
            <label for="website_url" class="block text-sm font-medium text-gray-700">Website URL<span class="text-red-500">*</label>
            <x-text-input id="website_url" class="block w-full mt-1" type="text" name="website_url" :value="old('website_url')" placeholder="Type 'Not Applicable' if no website" />
            <x-input-error :messages="$errors->get('website_url')" />
        </div>

        <!-- Phone Number (Philippine format) -->
        <div class="mb-6">
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number<span class="text-red-500">*</label>
            <x-text-input id="phone_number" class="block w-full mt-1" type="tel" name="phone_number" :value="old('phone_number')" placeholder="e.g., 09123456789" pattern="[0-9]{11}" maxlength="11" required />
            <x-input-error :messages="$errors->get('phone_number')" />
        </div>

        <!-- Billing Representative -->
        <div class="mb-6">
            <label for="billing_representative_first_name" class="block text-sm font-medium text-gray-700 mb-1">Billing Representative<span class="text-red-500">*</label>
            <div class="flex">
                <x-text-input id="billing_representative_first_name" class="block w-full mr-2" type="text" name="billing_representative_first_name" :value="old('billing_representative_first_name')" placeholder="First Name" required />
                <x-text-input id="billing_representative_last_name" class="block w-full ml-2" type="text" name="billing_representative_last_name" :value="old('billing_representative_last_name')" placeholder="Last Name" required />
            </div>
            <x-input-error :messages="$errors->get('billing_representative_first_name')" />
            <x-input-error :messages="$errors->get('billing_representative_last_name')" />
        </div>

        <!-- Telephone/Fax Number -->
        <div class="mb-6">
            <label for="telephone_fax_number" class="block text-sm font-medium text-gray-700">Telephone/Fax Number<span class="text-red-500">*</label>
            <x-text-input id="telephone_fax_number" class="block w-full mt-1" type="text" name="telephone_fax_number" :value="old('telephone_fax_number')" />
            <x-input-error :messages="$errors->get('telephone_fax_number')" />
        </div>

        <!-- Business Type -->
        <div class="mb-6">
            <label for="business_type" class="block text-sm font-medium text-gray-700">Business Type<span class="text-red-500">*</label>
            <select id="business_type" name="business_type_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" required>
                <option value="" disabled selected>Select</option>
                @foreach($businessTypes as $type)
                    <option value="{{ $type->id }}" @if(old('business_type_id') == $type->id) selected @endif>{{ $type->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('business_type_id')" />
        </div>


         <!-- Products or Services -->
         <div class="mb-6">
            <label for="products_or_services" class="block text-sm font-medium text-gray-700">Products or Services<span class="text-red-500">*</label>
            <textarea id="products_or_services" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" name="products_or_services" rows="4" placeholder="Enter products or services separated by commas">{{ old('products_or_services') }}</textarea>
            <x-input-error :messages="$errors->get('products_or_services')" />
        </div>

        <!-- Divider Header -->
        <div class="mt-8 mb-4">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Required Documents</h2>
            <hr>
        </div>

        <div class="space-y-6 bg-white p-6 rounded-md shadow-sm">
        <!-- BIR 2303 Upload -->
        <div class="grid grid-cols-1 gap-y-2 gap-x-4 sm:grid-cols-3">
            <label for="bir_2303" class="block text-sm font-medium text-gray-700 sm:col-span-1">
                BIR 2303 <span class="text-red-500">*</span>
            </label>
            <div class="sm:col-span-2">
                <input id="bir_2303" type="file" name="bir_2303" class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100" required onchange="toggleDatePicker('bir_2303', 'bir_2303_expiry')">
                <p class="text-blue-500 text-xs mt-2" id="bir_2303_expiry_label" style="display: none;">Set Document Expiry Date:</p>
                <input type="date" name="bir_2303_expiry" id="bir_2303_expiry" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" min="{{ date('Y-m-d') }}" required style="display: none;">
                <x-input-error :messages="$errors->get('bir_2303')" class="mt-1" />
            </div>
        </div>
        
        <!-- SEC Upload -->
        <div class="grid grid-cols-1 gap-y-2 gap-x-4 sm:grid-cols-3">
            <label for="sec" class="block text-sm font-medium text-gray-700 sm:col-span-1">
                SEC <span class="text-red-500">*</span>
            </label>
            <div class="sm:col-span-2">
                <input id="sec" type="file" name="sec" class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100" required onchange="toggleDatePicker('sec', 'sec_expiry')">
                <p class="text-blue-500 text-xs mt-2" id="sec_expiry_label" style="display: none;">Set Document Expiry Date:</p>
                <input type="date" name="sec_expiry" id="sec_expiry" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" min="{{ date('Y-m-d') }}" required style="display: none;">
                <x-input-error :messages="$errors->get('sec')" class="mt-1" />
            </div>
        </div>

        <!-- Mayor's Permit Upload -->
        <div class="grid grid-cols-1 gap-y-2 gap-x-4 sm:grid-cols-3">
            <label for="mayors_permit" class="block text-sm font-medium text-gray-700 sm:col-span-1">
                Mayor's Permit <span class="text-red-500">*</span>
            </label>
            <div class="sm:col-span-2">
                <input id="mayors_permit" type="file" name="mayors_permit" class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100" required onchange="toggleDatePicker('mayors_permit', 'mayors_permit_expiry')">
                <p class="text-blue-500 text-xs mt-2" id="mayors_permit_expiry_label" style="display: none;">Set Document Expiry Date:</p>
                <input type="date" name="mayors_permit_expiry" id="mayors_permit_expiry" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" min="{{ date('Y-m-d') }}" required style="display: none;">
                <x-input-error :messages="$errors->get('mayors_permit')" class="mt-1" />
            </div>
        </div>

         <!-- Terms and Conditions Checkbox -->
         <div class="flex items-center justify-center mb-5">
            <input id="terms_and_conditions" type="checkbox" name="terms_and_conditions" class="rounded-md text-red-500 border-gray-300 focus:ring-red-500" required>
            <label for="terms_and_conditions" class="ml-2 block text-sm text-gray-700">
                I agree to the <a href="{{ route('terms') }}" target="_blank" class="text-red-600 hover:underline">Terms and Conditions</a>
            </label>
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

<script>
    function toggleDatePicker(fileInputId, dateInputId) {
        const fileInput = document.getElementById(fileInputId);
        const dateInput = document.getElementById(dateInputId);
        const dateLabel = document.getElementById(dateInputId + '_label');

        if (fileInput.files.length > 0) {
            dateInput.style.display = 'block';
            dateLabel.style.display = 'block';
        } else {
            dateInput.style.display = 'none';
            dateLabel.style.display = 'none';
        }
    }
</script>

</x-guest-layout>

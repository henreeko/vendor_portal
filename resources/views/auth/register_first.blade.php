{{-- resources/views/auth/register_first.blade.php --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-guest-layout>
    <form id="firstStepForm" method="POST" action="{{ route('register.first-store') }}" class="space-y-6">
        @csrf
        
        <h5 class="text-2xl font-bold dark:text-white text-center">Account Set Up</h5>

        {{-- step indicator --}}
        <div class="flex justify-center items-center mt-8 space-x-4">
            <span class="flex w-3 h-3 me-3 bg-red-500 rounded-full"></span>
            <span class="flex w-3 h-3 me-3 bg-gray-200 rounded-full"></span>
        </div>

        <!-- First Name -->
        <div>
            <label for="first_name" class="block text-sm font-medium text-grvay-700">First Name</label>
            <x-text-input id="first_name" class="block w-full mt-1" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('first_name')" />
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <x-text-input id="last_name" class="block w-full mt-1" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('last_name')" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Already registered?') }}</a>
            <x-primary-button type="button" onclick="submitFirstStepForm()" class="ml-4">
                {{ __('Next') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // Function to handle form submission and navigate to the next step
        function submitFirstStepForm() {
            // Assuming your form has an ID "firstStepForm"
            var form = document.getElementById('firstStepForm');
    
            // Perform form validation (you can add your custom validation logic here)
            if (form.checkValidity()) {
                // Serialize form data to send via AJAX or fetch API
                var formData = new FormData(form);
    
                // Check if the password and confirmation match
                if (formData.get('password') !== formData.get('password_confirmation')) {
                    // Show SweetAlert2 toast error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Mismatch',
                        text: 'The password and confirmation do not match. Please try again.',
                        timer: 5000,
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        showCloseButton: true,
                        customClass: {
                            popup: 'error-toast',
                        },
                        background: '#f1f1f1',
                    });
                } else {
                    // Make an AJAX request to submit the form data
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => {
                        if (response.ok) {
                            // If form submission is successful, navigate to the second step
                            window.location.href = "{{ route('register.second') }}";
                        } else {
                            // Handle error response if needed
                            console.error('Error submitting form:', response.statusText);
                        }
                    })
                    .catch(error => {
                        // Handle network or other errors
                        console.error('Error submitting form:', error);
                    });
                }
            } else {
                // If form validation fails, display error messages to the user
                form.reportValidity();
            }
        }
    </script>
</x-guest-layout>

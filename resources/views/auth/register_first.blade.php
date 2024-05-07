{{-- resources/views/auth/register_first.blade.php --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-guest-layout>
    <style>
        .loader {
            border: 6px solid #f3f3f3; /* Light grey */
            border-top: 6px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -25px; /* Offset by half of width */
            margin-top: -25px; /* Offset by half of height */
            z-index: 100;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        </style>
        
        
    <form id="firstStepForm" method="POST" action="{{ route('register.first-store') }}" class="space-y-6">
        @csrf
        <div id="loader" class="loader" style="display: none;"></div>

        <h5 class="text-2xl font-bold dark:text-white text-center">Account Set Up</h5>
        <p class="text-xs dark:text-white text-center">First Step</p>

        {{-- step indicator --}}
        <div class="flex justify-center items-center mt-8 space-x-4">
            <span class="flex w-3 h-3 me-3 bg-red-500 rounded-full"></span>
            <span class="flex w-3 h-3 me-3 bg-gray-200 rounded-full"></span>
        </div>

        <!-- First Name -->
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
            <x-text-input id="first_name" class="block w-full mt-1" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('first_name')" />
                
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
            <x-text-input id="last_name" class="block w-full mt-1" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('last_name')" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>


        <div class="flex items-center justify-end">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">{{ __('Already registered?') }}</a>
            <x-primary-button type="button" onclick="submitFirstStepForm()" class="ml-4">
                {{ __('Next') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function submitFirstStepForm() {
            var form = document.getElementById('firstStepForm');
            var formData = new FormData(form);
            var loader = document.getElementById('loader');
        
            if (form.checkValidity()) {
                loader.style.display = 'block'; // Show the loader
        
                if (formData.get('password') !== formData.get('password_confirmation')) {
                    loader.style.display = 'none'; // Hide loader
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Mismatch',
                        text: 'The password and confirmation do not match. Please try again.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                    });
                } else {
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'), // Ensure CSRF token is sent
                        },
                    })
                    .then(response => {
                        loader.style.display = 'none'; // Hide loader on response
                        if (!response.ok) throw response;
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registration Started!',
                                text: 'You have completed the first step successfully!',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                didClose: () => {
                                    window.location.href = "{{ route('register.second') }}";
                                }
                            });
                        }
                    })
                    .catch(errorResponse => {
                        errorResponse.json().then(errorData => {
                            const firstErrorKey = Object.keys(errorData.errors)[0];
                            const firstErrorMessage = errorData.errors[firstErrorKey][0];
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: firstErrorMessage,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000,
                            });
                        }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An unexpected error occurred. Please try again.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000,
                            });
                        });
                    });
                }
            } else {
                form.reportValidity();
            }
        }
        </script>
        


</x-guest-layout>

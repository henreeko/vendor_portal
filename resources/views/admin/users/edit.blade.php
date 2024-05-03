<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">   
                        <p class="text-red-600 text-lg mb-1"> User Info
                            <p class="text-xs mb-3">Update the users's profile information and email address.</p>
                            <hr class="mb-5">
                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <!-- User Type -->
                            <div class="mb-4">
                                <label for="usertype" class="block text-sm font-medium text-gray-700">User Type</label>
                                <select name="usertype" id="usertype" class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <option value="admin" {{ old('usertype', $user->usertype) === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="procurement_officer" {{ old('usertype', $user->usertype) === 'procurement_officer' ? 'selected' : '' }}>Procurement Officer</option>
                                    <option value="procurement_head" {{ old('usertype', $user->usertype) === 'procurement_head' ? 'selected' : '' }}>Procurement Head</option>
                                </select>
                            </div>
                            <!-- First Name -->
                            <div class="mb-4">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            </div>

                            <!-- Last Name -->
                            <div class="mb-4">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            </div>

                            <!-- password header -->
                            <p class="text-red-600 text-lg mb-1"> Password Reset
                                <p class="text-xs mb-3">Note: Use this if the user has password issues.  </p>
                                <hr class="mb-5">

                            <!-- Password -->
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" autocomplete="new-password">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5" onclick="togglePasswordVisibility()">
                                        <svg id="passwordIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            </div>

                            <div class="mb-2 space-x-2">
                                <button type="submit" class="bg-gray-700 hover:bg-red-700 text-white font-bold py-2 px-3 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Update</button>
                                <a href="{{ route('admin.users.index') }}" class="text-gray-800 font-bold py-2 px-3 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
            let html = `<ul>`;
            @foreach ($errors->all() as $error)
                html += `<li>{{ $error }}</li>`;
            @endforeach
            html += `</ul>`;
    
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: html,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'colored-toast'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        @endif
    });
    </script>
    @endpush
    
    <script>
        function togglePasswordVisibility() {
            let passwordInput = document.getElementById('password');
            let icon = document.getElementById('passwordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.setAttribute('d', 'M5.121 5.121A7.975 7.975 0 0012 10a7.975 7.975 0 006.879-4.879m0 0A7.975 7.975 0 0112 14a7.975 7.975 0 01-6.879-4.879m0 0a7.975 7.975 0 0013.758 0');
            } else {
                passwordInput.type = 'password';
                icon.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0zm3 0C18 7.031 14.42 3 12 3S6 7.031 6 12s2.58 9 6 9 6-3.031 6-9zm-3 0a3 3 0 11-6 0 3 3 0 016 0z');
            }
        }
        </script>

</x-app-layout>


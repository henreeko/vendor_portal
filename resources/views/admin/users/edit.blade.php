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
                        Edit User: {{ $user->first_name }} {{ $user->last_name }}
                    </div>

                    <div class="mt-6">
                        <!-- User Edit Form -->
                        <form id="edit-user-form" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

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

                            <!-- User Type -->
                            <div class="mb-4">
                                <label for="usertype" class="block text-sm font-medium text-gray-700">User Type</label>
                                <select name="usertype" id="usertype" class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <option value="admin" {{ old('usertype', $user->usertype) === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="procurement_officer" {{ old('usertype', $user->usertype) === 'procurement_officer' ? 'selected' : '' }}>Procurement Officer</option>
                                    <option value="procurement_head" {{ old('usertype', $user->usertype) === 'procurement_head' ? 'selected' : '' }}>Procurement Head</option>
                                    <option value="vendor" {{ old('usertype', $user->usertype) === 'vendor' ? 'selected' : '' }}>Vendor</option>
                                </select>
                            </div>

                            <!-- Save Changes Button -->
                            <div class="mb-4">
                                <button type="submit" class="bg-gray-700 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Save Changes</button>
                                <a href="{{ route('admin.users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // Add event listener for form submission
        document.getElementById('edit-user-form').addEventListener('submit', function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();
    
            // Display a success message using SweetAlert
            swal("Success!", "User updated successfully!", "success").then((value) => {
                // Check if the user clicked the "OK" button
                if (value) {
                    // Redirect to the admin index page
                    window.location.href = "{{ route('admin.users.index') }}";
                }
            });
        });
    </script> --}}

</x-app-layout>

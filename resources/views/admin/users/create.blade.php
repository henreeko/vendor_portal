<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                    </div>

                    <div class="mt-6">
                        <form method="POST" action="{{ route('admin.users.store') }}">

                            @csrf

                            <div class="mb-4">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input id="first_name" type="text" class="mt-1 p-2 block w-full shadow-sm sm:text-sm rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                @error('first_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input id="last_name" type="text" class="mt-1 p-2 block w-full shadow-sm sm:text-sm rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input id="email" type="email" class="mt-1 p-2 block w-full shadow-sm sm:text-sm rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input id="password" type="password" class="mt-1 p-2 block w-full shadow-sm sm:text-sm rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" name="password" required autocomplete="new-password">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input id="password_confirmation" type="password" class="mt-1 p-2 block w-full shadow-sm sm:text-sm rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" name="password_confirmation" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="usertype" class="block text-sm font-medium text-gray-700">User Type</label>
                                <select id="usertype" class="mt-1 p-2 block w-full shadow-sm sm:text-sm rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" name="usertype" required>
                                    <option value="admin">Admin</option>
                                    <option value="procurement_officer">Procurement Officer</option>
                                    <option value="procurement_head">Procurement Head</option>
                                    <option value="vendor"> Vendor</option>
                                    <!-- Add other user types here -->
                                </select>
                                @error('usertype')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-2 space-x-2">
                                <button type="submit" class="bg-gray-700 hover:bg-red-700 text-white font-bold py-2 px-3 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Create User</button>
                                <a href="{{ route('admin.users.index') }}" class="text-gray-800 font-bold py-2 px-3 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


  
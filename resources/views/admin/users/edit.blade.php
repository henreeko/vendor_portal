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
                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
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
</x-app-layout>


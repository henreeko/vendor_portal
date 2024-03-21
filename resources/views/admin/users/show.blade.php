<!-- resources/views/admin/users/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <!-- User details -->
                    <div>
                        <div class="font-semibold">Name:</div>
                        <div>{{ $user->first_name }} {{ $user->last_name }}</div>
                    </div>
                    <div class="mt-4">
                        <div class="font-semibold">Email:</div>
                        <div>{{ $user->email }}</div>
                    </div>
                    <!-- Additional user details -->
                    <div class="mt-4">
                        <div class="font-semibold">User Type:</div>
                        <div>{{ $user->usertype }}</div>
                    </div>
                    <div class="mt-4">
                        <div class="font-semibold">Created At:</div>
                        <div>{{ $user->created_at->timezone('Asia/Manila')->format('Y-m-d h:i:s A') }}</div>
                    </div>
                    <div class="mt-4">
                        <div class="font-semibold">Updated At:</div>
                        <div>{{ $user->updated_at->timezone('Asia/Manila')->format('Y-m-d h:i:s A') }}</div>
                    </div>
                    <!-- Back button -->
                    <div class="mt-8">
                        <a href="{{ route('admin.users.index') }}" class="text-red-600 hover:text-indigo-900 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to User List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

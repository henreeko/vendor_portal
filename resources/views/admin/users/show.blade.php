<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- User Information Card -->
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">User Information</h3>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <!-- Name -->
                                    <div class="bg-white py-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </dd>
                                    </div>
                                    <!-- Email -->
                                    <div class="bg-gray-50 py-4 border-t border-gray-200">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Email
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $user->email }}
                                        </dd>
                                    </div>
                                    <!-- User Type -->
                                    <div class="bg-white py-4 border-t border-gray-200">
                                        <dt class="text-sm font-medium text-gray-500">
                                            User Type
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $user->usertype }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <!-- Dates Card -->
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Details</h3>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <!-- Created At -->
                                    <div class="bg-white py-4">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Created At
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $user->created_at->timezone('Asia/Manila')->format('Y-m-d h:i:s A') }}
                                        </dd>
                                    </div>
                                    <!-- Updated At -->
                                    <div class="bg-gray-50 py-4 border-t border-gray-200">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Updated At
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $user->updated_at->timezone('Asia/Manila')->format('Y-m-d h:i:s A') }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <!-- Back Button -->
                    <div class="mt-6">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

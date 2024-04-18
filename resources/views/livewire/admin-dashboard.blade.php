<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Admin Dashboard') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Each card is now clickable and includes a hover effect -->
        <!-- Total Users Card -->
        <a href="{{ route('admin.users.index') }}" class="bg-white overflow-hidden shadow rounded-lg transition duration-300 ease-in-out hover:-translate-y-1">
            <div class="p-6 flex items-center">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                      </svg>                      
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </a>

        <!-- Total Vendors Card -->
        <a href="#" class="bg-white overflow-hidden shadow rounded-lg transition duration-300 ease-in-out hover:-translate-y-1">
            <div class="p-6 flex items-center">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                      </svg>                      
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Vendors</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $totalVendors }}</p>
                </div>
            </div>
        </a>

        <!-- Approved Vendors Card -->
        <a href="{{ route('admin.vendors.index') }}" class="bg-white overflow-hidden shadow rounded-lg transition duration-300 ease-in-out hover:-translate-y-1">
            <div class="p-6 flex items-center">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                      </svg>                      
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Approved Vendors</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $approvedVendors }}</p>
                </div>
            </div>
        </a>

        <!-- Pending Vendors Card -->
        <a href="{{ route('procurement_officer.pending_vendors') }}" class="bg-white overflow-hidden shadow rounded-lg transition duration-300 ease-in-out hover:-translate-y-1">
            <div class="p-6 flex items-center">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                      </svg> 
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Vendors</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $pendingVendors }}</p>
                </div>
            </div>
        </a>

        <!-- Soft Deleted Users Card -->
        <a href="#" class="bg-white overflow-hidden shadow rounded-lg transition duration-300 ease-in-out hover:-translate-y-1">
            <div class="p-6 flex items-center">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                      </svg>                      
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Soft Deleted Users</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $softDeletedUsers }}</p>
                </div>
            </div>
        </a>
                <!-- Business Types Card -->
                <a href="{{ route('admin.business-types.index') }}" class="bg-white overflow-hidden shadow rounded-lg transition duration-300 ease-in-out hover:-translate-y-1">
                    <div class="p-6 flex items-center">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                              </svg>                                                           
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Business Types</p>
                            <p class="text-xl font-semibold text-gray-900">STATIC</p>
                        </div>
                    </div>
                </a>
    </div>
</div>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                    <!-- History Logs Table -->
                    <div class="bg-white rounded-lg shadow p-4 md:p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">History Logs</h3>
                        <table class="w-full text-sm text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">Date</th>
                                    <th scope="col" class="py-3 px-6">Event</th>
                                    <th scope="col" class="py-3 px-6">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="py-4 px-6">2023-04-01</td>
                                    <td class="py-4 px-6">New Vendor Added</td>
                                    <td class="py-4 px-6">Completed</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-4 px-6">2023-04-02</td>
                                    <td class="py-4 px-6">Vendor Data Updated</td>
                                    <td class="py-4 px-6">Pending</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-4 px-6">2023-04-03</td>
                                    <td class="py-4 px-6">Vendor Removed</td>
                                    <td class="py-4 px-6">Failed</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

        <!-- Chart Component Container -->
        <div class="ml-16 py-3">
            @livewire('vendor-registration-chart')
        </div>
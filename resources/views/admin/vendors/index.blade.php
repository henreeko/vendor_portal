<!-- resources/views/admin/vendors/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Vendors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <!-- Vendors List -->
                    <div class="mt-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Registered</th>
                                    <!-- Add more table headings as needed -->
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($vendors as $vendor)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->company_name }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $vendor->created_at->timezone('Asia/Manila')->format('Y-m-d') }}</td>
                                        <!-- Add more table cells for additional vendor information -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

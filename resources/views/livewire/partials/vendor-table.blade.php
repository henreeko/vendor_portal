<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 w-1">
                    <input type="checkbox" title="Select All" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500" wire:model="selectAll">
                </th>                
                <th scope="col" class="px-6 py-3 w-1/13">ID</th>
                <th scope="col" class="px-6 py-3 w-1/13">Vendor</th>
                <th scope="col" class="px-6 py-3 w-1/13">Representative</th>
                <th scope="col" class="px-6 py-3 w-1/13">Email</th>
                <th scope="col" class="px-6 py-3 w-1/13">Location</th>
                <th scope="col" class="px-6 py-3 w-1/13">Business Type</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3 w-1/12">Actions</th>    
            </tr>
        </thead>
        <tbody>
            @foreach($vendors as $vendor)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">
                    <input type="checkbox" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500" wire:model="selectedVendors" value="{{ $vendor->id }}">
                </td>
                <td class="px-6 py-4">
                    {{ $vendor->id }}
                </td>                         
                <td class="px-6 py-4">
                    <div class="font-medium text-gray-900 dark:text-white">{{ $vendor->company_name }}</div>
                    <div class="text-sm text-blue-500">{{ $vendor->supplier_type }}</div>
                </td>
                <td class="px-6 py-4 text-gray-900">{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $vendor->email }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $vendor->office_city }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $vendor->businessType->name ?? 'N/A' }}
                </td>
                <td class="px-6 py-4 text-gray-900">
                    <div class="flex items-center">
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Active
                    </div>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('vendors.show', $vendor) }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-blue-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-blue-100 bg-blue-50 hover:text-blue-600 hover:bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </td>
                
                {{-- <td>
                @include('livewire.partials.ven-modal', ['vendor' => $vendor])
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
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
                <th scope="col" class="px-6 py-3 w-1/13">Contact</th>
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
                <td class="px-6 py-4 text-gray-900">{{ $vendor->email }}<br>
                    {{ $vendor->phone_number }}</td>
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
                    View
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
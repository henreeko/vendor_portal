<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 w-1/12">
                    <input type="checkbox" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500" wire:model="selectAll">
                </th>                
                <th scope="col" class="px-6 py-3 w-1/12">ID</th>
                <th scope="col" class="px-6 py-3 w-1/12">Vendor</th>
                <th scope="col" class="px-6 py-3 w-1/12">Representative</th>
                <th scope="col" class="px-6 py-3 w-1/12">Email</th>
                <th scope="col" class="px-6 py-3 w-1/12">Location</th>
                <th scope="col" class="px-6 py-3 w-1/12">Business Type</th>
                <th scope="col" class="px-6 py-3 cursor-pointer w-1/12" wire:click="toggleSortDirection('created_at')">
                    <div class="flex items-center">
                        Registered
                        @if ($sortField === 'created_at')
                            <span class="ml-1">{!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}</span>
                        @endif
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Actions</th>    
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
                <td class="px-6 py-4 text-gray-900">{{ $vendor->businessType->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $vendor->created_at->timezone('Asia/Manila')->format('m-d-Y') }}</td>
                <td class="px-6 py-4 text-gray-900">
                    <div class="flex items-center">
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Active
                    </div>
                </td>
                @include('livewire.partials.ven-modal', ['vendor' => $vendor])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
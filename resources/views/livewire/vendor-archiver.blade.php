<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Archived Vendors') }}
    </h2>
</x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">     
    <div class="px-4 py-5 sm:p-6">

    <!-- SEARCH -->
    <div class="w-full max-w-xs mb-2 ">
    <input type="text" wire:model="search" placeholder="Search by company name or email" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
    </div>

    <!-- Conditional Bulk Action Button -->
    @if(count($selectedVendors) > 0)
    <button wire:click="unarchiveSelected" class="px-4 py-2 mb-4 inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        Unarchive Selected
    </button>
    @endif

    <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-900">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="select-all" wire:model="selectAll" class="hidden peer" required>
                        <label for="select-all" class="cursor-pointer peer-checked:[&_svg]:scale-100 text-sm font-medium text-neutral-600 peer-checked:text-gray-600 [&_svg]:scale-0 peer-checked:[&_.custom-checkbox]:border-gray-500 peer-checked:[&_.custom-checkbox]:bg-gray-500 select-none flex items-center space-x-2">
                            <span class="flex items-center justify-center w-5 h-5 border-2 rounded custom-checkbox text-neutral-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 text-white duration-300 ease-out">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </span>
                        </label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Company Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Business Type</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>

            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($archivedVendors as $vendor)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-900">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="vendor-{{ $vendor->id }}" value="{{ $vendor->id }}" wire:model="selectedVendors" class="hidden peer" required>
                        <label for="vendor-{{ $vendor->id }}" class="cursor-pointer peer-checked:[&_svg]:scale-100 text-sm font-medium text-neutral-600 peer-checked:text-gray-600 [&_svg]:scale-0 peer-checked:[&_.custom-checkbox]:border-gray-500 peer-checked:[&_.custom-checkbox]:bg-gray-500 select-none flex items-center space-x-2">
                            <span class="flex items-center justify-center w-5 h-5 border-2 rounded custom-checkbox text-neutral-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 text-white duration-300 ease-out">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </span>
                        </label>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $vendor->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $vendor->company_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $vendor->businessType->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $vendor->email }}</td>
                <td class="px-6 py-4 text-left whitespace-nowrap text-sm text-blue-500 hover:underline"> @include('livewire.partials.slide')</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-left text-sm text-red-600">No archived vendors found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('livewire:load', function () {
    Livewire.rescan();
});

    document.addEventListener('livewire:load', function () {
        window.addEventListener('notify', event => {
            const type = event.detail.type; // 'success' or 'error'
            const message = event.detail.message;
    
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 1500,
                timerProgressBar: true,
                icon: type,
                title: message,
                background: '#ffffff',
                color: '#333333' 
            });
        });
    });
    </script>
    
    
    
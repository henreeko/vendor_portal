<div class="my-5 ml-5 mr-5 flex flex-col sm:flex-row gap-4 justify-between items-center pb-4">
    <!-- Sort Button -->
    <button wire:click="sortByCompanyNameAtoZ" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none" title="Sort A-Z by Company Name">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
           <path fill-rule="evenodd" d="M13.78 10.47a.75.75 0 0 1 0 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 1 1 1.06-1.06l.97.97V5.75a.75.75 0 0 1 1.5 0v5.69l.97-.97a.75.75 0 0 1 1.06 0ZM2.22 5.53a.75.75 0 0 1 0-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1-1.06 1.06l-.97-.97v5.69a.75.75 0 0 1-1.5 0V4.56l-.97.97a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd" />
        </svg>          
    </button>

    <!-- Search Input -->
    <div class="relative flex-1 min-w-0">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-900 dark:text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input wire:model.debounce.300ms="search" type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-200 focus:border-gray-200 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Search vendors...">
    </div>

    <!-- Date Picker -->
    <div class="relative flex-1 min-w-0">
        <input type="date" wire:model="selectedDate" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-200 focus:border-gray-200 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
    </div>

    <!-- Supplier Type Filter -->
    <div class="relative z-50" wire:ignore.self>
        <!-- Trigger -->
        <button wire:click.stop="toggleDropdown"
            title="Sort By Supplier Type"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 h-10 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-md hover:bg-neutral-100 active:bg-neutral-200 focus:ring-gray-200 focus:border-gray-200">
            {{ $supplierType ?: 'Type' }}
            <!-- Conditionally rendered SVG icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                @if($openDropdown)
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /> <!-- Up arrow -->
                @else
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /> <!-- Down arrow -->
                @endif
            </svg>
        </button>

        <!-- Dropdown -->
        @if ($openDropdown)
            <div class="absolute right-0 z-50 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg">
                <div class="py-1">
                    <a href="#" wire:click.prevent="setSupplierType('local')" class="block px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Local</a>
                    <a href="#" wire:click.prevent="setSupplierType('foreign')" class="block px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Foreign</a>
                </div>
            </div>
        @endif
    </div>
    
            <!-- Business Type Filter -->
            <div class="relative flex-1 min-w-0">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 text-gray-900">
                        <path fill-rule="evenodd" d="M11 4V3a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v1H4a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1ZM9 2.5H7a.5.5 0 0 0-.5.5v1h3V3a.5.5 0 0 0-.5-.5ZM9 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" clip-rule="evenodd" />
                        <path d="M3 11.83V12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-.17c-.313.11-.65.17-1 .17H4c-.35 0-.687-.06-1-.17Z" />
                      </svg>                      
                </div>
                <select wire:model="businessTypeFilter" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-200 focus:border-gray-200 block w-full pl-10 p-2.5">
                    <option value="">All Business Types</option>
                    @foreach($this->businessTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

<!-- Reset Filters Button -->
<button wire:click.stop="resetFilters" wire:click="$emit('filtersReset')"
    class="h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none" title="Reset Filters">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
        <path fill-rule="evenodd" d="M13.836 2.477a.75.75 0 0 1 .75.75v3.182a.75.75 0 0 1-.75.75h-3.182a.75.75 0 0 1 0-1.5h1.37l-.84-.841a4.5 4.5 0 0 0-7.08.932.75.75 0 0 1-1.3-.75 6 6 0 0 1 9.44-1.242l.842.84V3.227a.75.75 0 0 1 .75-.75Zm-.911 7.5A.75.75 0 0 1 13.199 11a6 6 0 0 1-9.44 1.241l-.84-.84v1.371a.75.75 0 0 1-1.5 0V9.591a.75.75 0 0 1 .75-.75H5.35a.75.75 0 0 1 0 1.5H3.98l.841.841a4.5 4.5 0 0 0 7.08-.932.75.75 0 0 1 1.025-.273Z" clip-rule="evenodd" />
    </svg>
</button>
</div>

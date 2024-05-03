{{-- views\livewire\partials\menu-bar.blade.php --}}
<div class="px-6 py-4">
    <div x-data="{ menuOpen: false }" class="relative">
        <!-- Trigger Button -->
        <button @click="menuOpen = !menuOpen" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100">
            Options
        </button>

        <!-- Dropdown Menu -->
        <div x-show="menuOpen" @click.away="menuOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1">
                <!-- Archive Option -->
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Archive Vendor
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Edit Vendor
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-blue-500 hover:underline">
                    Export
                </a>
            </div>
        </div>
    </div>
</div>

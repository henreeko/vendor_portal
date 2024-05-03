{{-- views\admin\vendors\index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Approved Vendors') }}
        </h2>
    </x-slot>

    <!-- Responsive container for the table -->
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Include Livewire component here -->
                    @livewire('vendors-list')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

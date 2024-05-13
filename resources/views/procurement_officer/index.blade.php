<!-- resources/views/procurement_officer/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Procurement Officer Dashboard') }}
        </h2>
    </x-slot>

    @livewire('procurement-officer-stats')
    
</x-app-layout>

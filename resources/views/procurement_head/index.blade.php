<!-- resources/views/procurement_head/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Procurement Head Dashboard') }}
        </h2>
    </x-slot>

    @livewire('procurement-head-stats')

</x-app-layout>


<!-- resources/views/procurement_head/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Procurement Head Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
               <!-- Your content goes here -->
               <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Add content specific to procurement officer dashboard -->
                        <p>Welcome, Sir {{ Auth::user()->first_name }}!</p>
                        <!-- Add more content as needed -->
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>


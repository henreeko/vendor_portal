<div x-data="{ open: false }">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Business Types') }}
        </h2>
    </x-slot>

        <!-- table container -->
        <div class="flex flex-col items-center px-4 py-5">
        <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">  

        {{-- Search Bar --}}
        <div class="relative flex-1 min-w-0">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-900 dark:text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="search" wire:model.debounce.300ms="search" placeholder="Search business types..." class="form-input">
        </div>


    <!-- Alpine.js component for modal visibility, isolated specifically for the modal -->
    <div x-data="{ modalOpen: false }" @open-modal.window="modalOpen = true" @close-modal.window="modalOpen = false">
    <!-- Button to trigger modal -->
    <button @click.prevent="modalOpen = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Add Business Type
    </button>

    <!-- Modal -->
    <div x-show="modalOpen" class="fixed inset-0 z-30 flex items-center justify-center w-full h-full bg-black bg-opacity-50" x-cloak>        <div class="bg-white p-4 rounded-lg shadow-lg max-w-sm w-full">
            <div class="text-right">
                <button @click="modalOpen = false" class="text-black text-xl font-bold">&times;</button>
            </div>
            <h3 class="text-lg font-bold text-center mb-4">Add New Business Type</h3>
            <!-- Form to add a new business type -->
            <form wire:submit.prevent="createBusinessType">
                <input type="text" wire:model.defer="newTypeName" placeholder="Enter business type name" class="border p-1 rounded w-full mb-4">
                @error('newTypeName')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                    Add
                </button>
            </form>            
        </div>
    </div>
</div>
        <!-- alpine end -->

        <!-- Table for displaying business types -->
        <div class="inline-block min-w-full py-2">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-neutral-200">
                    <thead class="bg-gray-900">
                        <tr class="text-white">
                            <th class="px-3 py-2 text-xs font-medium text-left uppercase">Business Type</th>
                            <th class="px-3 py-2 text-xs font-medium text-left uppercase">Created At</th>
                            <th class="px-3 py-2 text-xs font-medium text-left uppercase">Updated At</th>
                            <th class="px-3 py-2 text-xs font-medium text-center uppercase"></th>
                            <th class="px-3 py-2 text-xs font-medium text-left uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tbody class="divide-y divide-neutral-200 bg-white">
                            @foreach($businessTypes as $type)
                            <tr class="text-neutral-800">
                                <td class="px-3 py-2 text-sm font-medium whitespace-nowrap">
                                    {{ $type->name }}
                                </td>
                                <td class="px-3 py-2 text-sm whitespace-nowrap">
                                    {{ $type->created_at ? $type->created_at->format('M d, Y') : 'Not available' }}
                                </td>
                                <td class="px-3 py-2 text-sm whitespace-nowrap">
                                    {{ $type->updated_at ? $type->updated_at->format('M d, Y') : 'Not available' }}
                                </td>
                                <td class="px-3 py-2 text-sm font-medium text-right whitespace-nowrap">
                                    <a href="#" class="text-blue-600 hover:text-blue-700">Edit</a>
                                </td>
                                <td class="px-3 py-2 text-sm font-medium">
                                    <a href="#" class="text-red-600 hover:text-red-700">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



    <script>
    window.addEventListener('DOMContentLoaded', () => {
    window.addEventListener('notify', e => {
        alert(e.detail); // Replace this with a more sophisticated notification system if needed
    });
});
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.addEventListener('swal:toast', event => {
            Swal.fire({
                toast: true,
                position: event.detail.position || 'top-end',
                showConfirmButton: event.detail.showConfirmButton || false,
                timer: event.detail.timer || 3000,
                timerProgressBar: event.detail.timerProgressBar || false,
                icon: event.detail.icon || 'success',
                title: event.detail.title || 'Operation Successful'
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                icon: event.detail.icon,
                title: event.detail.title,
                text: event.detail.text || '',
                confirmButtonText: 'OK'
            });
        });

        window.addEventListener('swal:toast', event => {
            Swal.fire({
                toast: true,
                position: event.detail.position || 'top-end',
                showConfirmButton: event.detail.showConfirmButton || false,
                timer: event.detail.timer || 3000,
                timerProgressBar: event.detail.timerProgressBar || false,
                icon: event.detail.icon,
                title: event.detail.title
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.addEventListener('swal:toast', event => {
            Swal.fire({
                toast: true,
                position: event.detail.position || 'top-end',
                showConfirmButton: event.detail.showConfirmButton || false,
                timer: event.detail.timer || 3000,
                timerProgressBar: event.detail.timerProgressBar || false,
                icon: event.detail.icon,
                title: event.detail.title
            });
        });
    });
</script>

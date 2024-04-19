<div x-data="{ open: false }">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Business Types') }}
        </h2>
    </x-slot>

<!-- Main container with padding and centralized alignment -->
<div class="flex flex-col items-center px-4 py-5">
    <div class="container">
    <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Display total count with a bit more padding and a subtle background for emphasis -->
        <div class="p-4 bg-gray-50 rounded-md shadow">
            <p class="text-xl font-semibold text-gray-900">Total: {{ $count }}</p>
        </div>

        <!-- Search Bar with proper alignment and full width utilization -->
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-500" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="search" wire:model.debounce.300ms="search" placeholder="Search business types..."
            class="w-full pl-10 pr-4 py-2 mt-4 mb-4 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-200 focus:border-gray-200">
        </div>

        <!-- Include other components or modals -->
        <div>
            @include('livewire.partials.bus-modal')
        </div>

        <!-- Table for displaying business types -->
        <div class="inline-block min-w-full py-2">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-neutral-200">
                    <thead class="bg-gray-900">
                        <tr class="text-white">
                            <th class="px-3 py-2 text-xs font-medium text-left uppercase">ID</th>
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
                                    {{ $type->id}}
                                </td>
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


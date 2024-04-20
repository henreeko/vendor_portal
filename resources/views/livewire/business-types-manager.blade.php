<div x-data="{ open: false }" class="py-8">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manage Business Types') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <!-- Search Bar -->
                <div class="mb-4">
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input wire:model.debounce.300ms="search" type="text" placeholder="Search business types..." class="block w-full pl-10 pr-4 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div>
                    @include('livewire.partials.bus-modal')
                </div>
                <!-- Business Types Table -->
                <div class="flex flex-col mt-8">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            ID
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Business Type
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Created At
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Updated At
                                        </th>
                                        <th scope="col" class="relative px-3 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($businessTypes as $type)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $type->id }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $type->name }}
                                        </td>
                                        <td class="px-3 py-2 text-sm whitespace-nowrap">
                                            {{ $type->created_at ? $type->created_at->format('M d, Y') : 'Not available' }}
                                        </td>
                                        <td class="px-3 py-2 text-sm whitespace-nowrap">
                                            {{ $type->updated_at ? $type->updated_at->format('M d, Y') : 'Not available' }}
                                        </td>
                                        <td class="px-3 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <br>
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Archive</a>
                                            <br>
                                            <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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


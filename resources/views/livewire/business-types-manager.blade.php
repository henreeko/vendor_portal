<div class="py-8">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manage Business Types') }}
        </h2>
    </x-slot>
        <!-- Edit Modal -->
        @if($showEditModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 py-8 backdrop-grayscale-0 bg-white/60">
                <div class="relative w-full max-w-md p-4 mx-auto bg-white rounded-md shadow-lg">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Edit Business Type</h3>
                        <form wire:submit.prevent="updateBusinessType" class="mt-4">
                            <input type="hidden" wire:model="editBusinessTypeId">
                            <input type="text" wire:model.defer="editBusinessTypeName" class="w-full px-3 py-2 border rounded-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Business type name">
                            @error('editBusinessTypeName')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            <div class="mt-4 text-right">
                                <button type="button" wire:click="toggleEditModal" class="px-4 py-2 mr-2 text-sm text-gray-600 bg-white border rounded-md hover:bg-gray-100">Cancel</button>
                                <button type="submit" class="px-4 py-2 text-sm text-white bg-gray-900 rounded-md hover:bg-gray-800">Update</button>
                            </div>
                        </form>
                    </div>
                    <button wire:click="toggleEditModal" class="absolute top-0 right-0 mt-4 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
@endif
                <!-- Modal -->
                @if($showModal)
                <div class="fixed inset-0 z-50 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4 py-8 backdrop-grayscale-0 bg-white/60">
                        <div class="relative w-full max-w-md p-4 mx-auto bg-white rounded-md shadow-lg">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Add Business Type</h3>
                                <form wire:submit.prevent="createBusinessType" class="mt-4">
                                    <input type="text" wire:model.defer="newTypeName" class="w-full px-3 py-2 border rounded-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Business type name">
                                    @error('newTypeName')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                    <div class="mt-4 text-right">
                                        <button type="button" wire:click="toggleModal" class="px-4 py-2 mr-2 text-sm text-gray-600 bg-white border rounded-md hover:bg-gray-100">Cancel</button>
                                        <button type="submit" class="px-4 py-2 text-sm text-white bg-gray-900 rounded-md hover:bg-gray-800">Add</button>
                                    </div>
                                </form>
                            </div>
                            <button wire:click="toggleModal" class="absolute top-0 right-0 mt-4 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <div class="flex justify-between">
                    <!-- Search Bar -->
                    <input wire:model.debounce.300ms="search" type="text" placeholder="Search business types..." class="h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 ml-6">
                    
                    <!-- Button to trigger modal -->
                    <button wire:click="showAddModal" class="mr-6 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border rounded-md text-gray-900 hover:text-neutral-700 border-neutral-200/70 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mr-2">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z" clip-rule="evenodd" />
                        </svg> 
                        Add Business Type
                    </button>
                </div>

                <div class="py-1">
                <div class="my-5 ml-5 mr-5 relative overflow-x-auto shadow-md sm:rounded-lg">
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-sm text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="w-1/12 px-6 py-3 text-xs font-medium text-white uppercase text-center">ID</th>
                                <th class="w-3/12 px-6 py-3 text-xs font-medium text-white uppercase text-left">Business Type</th>
                                <th wire:click="sortBy('created_at')" class="cursor-pointer px-6 py-3 text-xs font-medium text-white uppercase text-center">
                                    Created At
                                    @if($sortField === 'created_at')
                                        @if($sortAsc)
                                            <span>&#9650;</span>
                                        @else
                                            <span>&#9660;</span>
                                        @endif
                                    @endif
                                </th>                                
                                <th class="w-3/12 px-6 py-3 text-xs font-medium text-white uppercase text-center">Updated At</th>
                                <th class="w-2/12 px-6 py-3 text-xs font-medium text-white uppercase text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($businessTypes as $type)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $type->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 text-left">{{ $type->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $type->created_at ? $type->created_at->format('M d, Y') : 'Not available' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $type->updated_at ? $type->updated_at->format('M d, Y') : 'Not available' }}</td>
                                <td class="px-6 py-4 text-sm text-center">
                                    <a href="#" wire:click.prevent="showEditModal({{ $type->id }})" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                    <button wire:click="confirmDelete({{ $type->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <!-- Pagination -->
        <div class="mt-4 ml-5 mr-5">
        {{ $businessTypes->links() }}
        </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        window.livewire.on('toast', (type, message) => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                icon: type,
                title: message,
            });
        });

        window.livewire.on('toggleModal', () => {
            document.getElementById('modal').classList.toggle('hidden');
        });
    });
</script>
@endpush


@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        // Listen for the 'confirm-delete' event and show the confirmation dialog
        window.livewire.on('confirm-delete', () => {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this business type!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteBusinessType'); // Emit an event to delete the business type
                }
            });
        });

        // Listen for the 'toast' event and show toast notifications
        window.livewire.on('toast', (type, message) => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                icon: type,
                title: message,
            });
        });
    });
</script>
@endpush
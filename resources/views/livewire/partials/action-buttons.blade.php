{{-- \views\livewire\partials\action-buttons.blade.php --}}
@if(count($selectedVendors) > 0)
<div class="relative flex-1 min-w-0" x-data="{ isConfirmingArchive: false }">

    <!-- Confirmation Modal for Archiving -->
    <div    
    x-show="isConfirmingArchive" 
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">>
        <div class="p-5 bg-white rounded-lg shadow-xl">
            <h2 class="text-lg font-bold">Confirm Archive</h2>
            <p class="mb-4">Are you sure you want to archive the selected vendors?</p>
            <button @click="isConfirmingArchive = false; $wire.archiveSelected();" class="mr-2 inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Yes, Archive
            </button>
            <button @click="isConfirmingArchive = false" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
                Cancel
            </button>
        </div>
    </div>

    <!-- Button to Open Confirmation Modal -->
    <button @click="isConfirmingArchive = true" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        Archive Selected
    </button>
</div>
@endif

<script>
    document.addEventListener('livewire:load', function () {
        window.addEventListener('notify', event => {
            const type = event.detail.type; // 'success' or 'error'
            const message = event.detail.message;
    
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true,
                icon: type,
                title: message,
                background: '#ffffff',
                color: '#333333'
            });
        });
    });
    </script>
    
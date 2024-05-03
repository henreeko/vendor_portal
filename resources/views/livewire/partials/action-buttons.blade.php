{{-- \views\livewire\partials\action-buttons.blade.php --}}
@if(count($selectedVendors) > 0)
<div class="relative flex-1 min-w-0">

    <button wire:click="exportSelected" class="mb-2 inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        Export
    </button>
    <div>
        <button wire:click="archiveSelected" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
            Archive Selected
        </button>
    </div>
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
                timer: 1500,
                timerProgressBar: true,
                icon: type,
                title: message,
                background: '#ffffff', // Set to white background
                color: '#333333' // Default text color for better visibility
            });
        });
    });
    </script>
    
    
    
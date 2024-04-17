{{-- \views\livewire\partials\action-buttons.blade.php --}}
@if(count($selectedVendors) > 0)
<div class="px-6 py-4 flex justify-end space-x-3">
    <button wire:click="exportSelected" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        Export
    </button>
    <button wire:click="archiveSelected" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        Archive
    </button>
</div>
@endif


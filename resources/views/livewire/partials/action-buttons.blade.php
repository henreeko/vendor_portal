{{-- \views\livewire\partials\action-buttons.blade.php --}}
@if(count($selectedVendors) > 0)
<div class="relative flex-1 min-w-0">

    <!-- Confirmation Modal for Archiving -->
    <div id="archiveModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background Overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="toggleArchiveModal(false)" aria-hidden="true"></div>

            <!-- Modal Panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-500 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                              </svg>                              
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Confirm Archive
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to archive the selected vendors?</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" onclick="confirmArchive()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Yes, Archive
                        </button>
                        <button type="button" onclick="toggleArchiveModal(false)" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button to Open Confirmation Modal -->
    <button onclick="toggleArchiveModal(true)" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-gray-900 bg-white border rounded-md hover:bg-neutral-100 focus:outline-none">
        Archive Selected
    </button>
</div>
@endif

<script>
    function toggleArchiveModal(show) {
        const modal = document.getElementById('archiveModal');
        if (show) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    function confirmArchive() {
        toggleArchiveModal(false);
        @this.archiveSelected();
    }

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

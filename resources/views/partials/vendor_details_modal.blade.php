<!-- Modal Structure -->
<div id="modal{{ $vendor->id }}" class="hidden fixed inset-0 z-10 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- Use transform to perfectly center the modal -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" style="transform: translate(-50%, -50%); top: 50%; left: 50%; position: absolute;">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Icon or Image Here -->
                        <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Vendor Reassessment Details</h3>
                        <div class="mt-2">
                            <!-- Message Box -->
                            <div class="p-4 bg-white border border-yellow-200 rounded-md shadow-sm">
                                <p class="text-xs leading-6 font-medium text-gray-900">Message:</p>
                                <p class="text-sm text-gray-900">
                                    {{ $vendor->reassessment_message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 sm:px-6 flex justify-between items-center">
                <p class="text-sm text-gray-600">
                    From: Procurement Head
                </p>
                <p class="text-sm text-gray-500">
                    {{ $vendor->updated_at->format('M-d-Y') }}
                </p>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeModal('modal{{ $vendor->id }}')" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

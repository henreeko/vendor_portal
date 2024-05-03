<div x-data="{ showModal: false }">
    <!-- Button to toggle modal -->
    <button @click="showModal = !showModal" class="btn btn-primary text-yellow-500">Request for an update</button>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <!-- Close button -->
                        <button @click="showModal = false" class="absolute top-0 right-0 p-2 m-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <!-- Request form -->
                        <form wire:submit.prevent="submitRequest" class="w-full">
                            <div class="mb-4">
                                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                                <textarea wire:model="message" class="form-textarea mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="message" placeholder="Optional message..."></textarea>
                            </div>
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-yellow-600 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-yellow-100 bg-yellow-50 hover:text-yellow-700 hover:bg-yellow-100">Request Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

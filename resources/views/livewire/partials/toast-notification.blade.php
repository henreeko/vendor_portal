<div x-data="{ show: false, message: 'Notification' }"
     x-show.transition.opacity="show"
     @notify-sort.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000);"
     class="font-mono fixed top-0 right-0 p-4 mt-4 mr-4 bg-white border text-xs text-gray-900 rounded-3xl flex items-center space-x-2"
     style="display: none;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 text-green-500">
        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
    </svg>
    <p x-text="message"></p>
</div>


<div x-data="{ show: false, message: 'Filters have been reset!' }"
    x-show.transition.opacity="show"
    x-init="@this.on('filtersReset', () => { show = true; setTimeout(() => show = false, 3000); })"
    class="font-mono fixed top-0 right-0 p-4 mt-4 mr-4 bg-white border text-xs text-gray-900 rounded-3xl flex items-center space-x-2"
    style="display: none;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 text-green-500">
        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
    </svg>
    <p x-text="message"></p>
</div>
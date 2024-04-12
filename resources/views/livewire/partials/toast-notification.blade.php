<div x-data="{ show: false, message: 'erro' }"
     x-show.transition.opacity="show"
     @notify-sort.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000);"
     class="fixed top-0 right-0 p-4 mt-4 mr-4 bg-green-500 text-white rounded-lg"
     style="display: none;">
    <p x-text="message"></p>
</div>

<div x-data="{ show: false, message: 'Filters have been reset!' }"
    x-show.transition.opacity="show"
    x-init="@this.on('filtersReset', () => { show = true; setTimeout(() => show = false, 3000); })"
    class="fixed top-0 right-0 p-4 mt-4 mr-4 bg-green-500 text-white rounded-lg" 
    style="display: none;">
    <p x-text="message"></p>
</div>
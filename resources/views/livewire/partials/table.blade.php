<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead>...Column Titles...</thead>
    <tbody>
        @foreach($vendors as $vendor)
            @include('livewire.partials.table-row', ['vendor' => $vendor])
        @endforeach
    </tbody>
</table>
{{ $vendors->links() }}

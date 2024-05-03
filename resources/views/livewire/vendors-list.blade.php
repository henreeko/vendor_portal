{{-- views\livewire\vendors-list.blade.php --}}
<div class="relative overflow-x-auto">
  @include('livewire.partials.toast-notification')
  @include('livewire.partials.filters')
  @include('livewire.partials.vendor-table')
  <div class="mr-5">
  {{ $vendors->links() }}
  <br>
  </div>
</div>

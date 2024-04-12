<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  @include('livewire.partials.toast-notification')
  @include('livewire.partials.action-buttons')
  @include('livewire.partials.filters')
  @include('livewire.partials.vendor-table')
  <div class="mr-5">
  {{ $vendors->links() }}
  <br>
  </div>
</div>

{{-- view\livewire\documents-table.blade.php --}}
<!-- Docs table -->
<!-- Documents Section -->
<h2 class="px-6 py-2 text-lg font-semibold text-gray-900 bg-none dark:bg-gray-700 dark:text-white">Documents</h2>
<hr class="mb-5">
<div class="px-4 sm:px-6 lg:px-8">
  <div class="align-middle inline-block min-w-full">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-900">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
              Document
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
              Expiry Date
            </th>
            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
              Actions
            </th>
            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
            </th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          <!-- Dynamic row generation -->
          @foreach($documents as $document)
          <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                  {{ $document->name }}
                  <div class="text-xs text-gray-500">{{ $document->document_type }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                  {{ $document->expiry_date ? $document->expiry_date->format('F-d-Y') : 'N/A' }}
                  @if($document->expiry_date && $document->expiry_date->isPast())
                      <span class="text-xs text-red-500 ml-2">(Expired)</span>
                  @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <a href="{{ Storage::url($document->path) }}" title="View document" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400">View</a>
                  <a href="{{ Storage::url($document->path) }}" download="{{ $document->name }}" title="Download document" class="ml-4 text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400">Download</a>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                @livewire('document-update-request-form', ['documentId' => $document->id], key($document->id))
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

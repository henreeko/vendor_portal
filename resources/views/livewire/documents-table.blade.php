{{-- views\livewire\documents-table.blade.php --}}
<!-- Documents Section -->
<div class="px-4 sm:px-6 lg:px-8 mb-6">
  <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-50 dark:bg-gray-900">
              <tr>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                      Document
                  </th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                      Expiry Date
                  </th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                      Registration Date
                  </th>
                  <th scope="col" class="px-9 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                      Actions
                  </th>
              </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              <!-- Dynamic row generation -->
              @foreach($documents as $document)
              <tr>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                      {{ $document->name }}
                      <div class="text-xs text-blue-500">{{ $document->document_type }}</div>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $document->expiry_date ? $document->expiry_date->format('F-d-Y') : 'N/A' }}
                      @if($document->expiry_date && $document->expiry_date->isPast())
                          <span class="text-xs text-red-500 ml-2">(Expired)</span>
                      @endif
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $document->document_type === 'sec' ? ($document->registration_date ? $document->registration_date->format('F-d-Y') : 'N/A') : 'N/A' }}
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ Storage::url($document->path) }}" title="View document" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400 mr-4">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-1">
                        <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                        <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" clip-rule="evenodd" />
                      </svg>                        
                      View
                    </a>
                    <a href="{{ Storage::url($document->path) }}" download="{{ $document->name }}" title="Download document" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-1">
                        <path d="M10.75 2.75a.75.75 0 0 0-1.5 0v8.614L6.295 8.235a.75.75 0 1 0-1.09 1.03l4.25 4.5a.75.75 0 0 0 1.09 0l4.25-4.5a.75.75 0 0 0-1.09-1.03l-2.955 3.129V2.75Z" />
                        <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                      </svg>                        
                      Download
                    </a>                    
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>

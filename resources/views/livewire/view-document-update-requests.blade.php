<div class="flex flex-wrap justify-center gap-4 m-4">
    @foreach ($updateRequests as $request)
        <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <span class="inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <h1 class="font-bold text-3xl">{{ $request->vendorDocument->name }}</h1>
                </span>
                
                <hr class="mb-2 mt-2">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <p class="text-red-600 font-bold">Requested by: </p>{{ $request->requestedByUser->first_name }} {{ $request->requestedByUser->last_name }}<br>
                    <p class="text-red-600 font-bold"> Message: </p>{{ $request->message }}<br>
                    <p class="text-red-600 font-bold"> Requested at: </p>{{ $request->requested_at }}
                </p>
                <hr class="mt-2 mb-2">
                <div class="flex justify-end space-x-4">
                <!-- Update Document Button -->
                <a href="#" title="Update Document" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-yellow-500 rounded-lg hover:bg-yellow-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                      </svg>                      
                </a>

                <!-- View Document Button -->
                <a href="#" title="View Document" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-blue-500 rounded-lg hover:bg-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                      </svg>                      
                </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
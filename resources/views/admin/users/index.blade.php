<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            User Management
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Users
                            <span class="text-sm text-gray-500">Total: {{ $users->total() }}</span> <br> <br>
                            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:indigo-yellow-500">
                                Add New User
                            </a>
                        </h3>
                        
                    </div>

                    <!-- Filters -->
                    <form method="GET" action="{{ route('admin.users.index') }}" class="mt-5 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <input type="text" name="search" placeholder="Search by name or email..." value="{{ request('search') }}" class="form-input rounded-md shadow-sm mt-1 block w-full border-gray-200 focus:border-gray-500 focus:ring focus:ring-gray-100 focus:ring-opacity-50">
                        
                        <select name="usertype" class="form-select rounded-md shadow-sm mt-1 block w-full border-gray-200 focus:border-gray-500 focus:ring focus:ring-gray-100 focus:ring-opacity-50">
                            <option value="">All User Types</option>
                            <option value="admin" @if(request('usertype') == 'admin') selected @endif>Admin</option>
                            <option value="procurement_officer" @if(request('usertype') == 'procurement_officer') selected @endif>Procurement Officer</option>
                            <option value="procurement_head" @if(request('usertype') == 'procurement_head') selected @endif>Procurement Head</option>
                            <option value="vendor" @if(request('usertype') == 'vendor') selected @endif>Vendor</option>
                        </select>

                        <input type="date" name="created_at" value="{{ request('created_at') }}" class="form-input rounded-md shadow-sm mt-1 block w-full border-gray-200 focus:border-gray-500 focus:ring focus:ring-gray-100 focus:ring-opacity-50" placeholder="Select date">
                        
                        {{-- Buttons --}}
                        <div class="flex space-x-2 items-center">
                            <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                  </svg>                                  
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                                  </svg>   
                            </a>
                        </div>
                    </form>
                    
                    <div class="mt-4">
                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-700">
                                <thead class="text-xs text-white uppercase bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Name
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Email
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            User Type
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            <a href="{{ route('admin.users.index', ['sort' => 'created_at', 'direction' => request('direction') == 'desc' && request('sort') == 'created_at' ? 'asc' : 'desc']) }}">
                                                Created At
                                                @if(request('sort') == 'created_at')
                                                    {!! request('direction') == 'asc' ? '&uarr;' : '&darr;' !!}
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            <a href="{{ route('admin.users.index', ['sort' => 'updated_at', 'direction' => request('direction') == 'desc' && request('sort') == 'updated_at' ? 'asc' : 'desc']) }}">
                                                Updated At
                                                @if(request('sort') == 'updated_at')
                                                    {!! request('direction') == 'asc' ? '&uarr;' : '&darr;' !!}
                                                @endif
                                            </a>
                                        </th>
                                        
                                        <th scope="col" class="py-3 px-6 text-center">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="py-4 px-6">
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $user->email }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $user->usertype }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $user->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $user->updated_at->format('Y-m-d') }}
                                        </td>

                                        {{-- ACTION BUTTONS --}}
                                        <td class="py-4 px-6 text-right">
                                            <div class="flex justify-end items-center space-x-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-gray-800 hover:text-gray-900 px-2 py-1 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                    <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                                  </svg>
                                                  </a>
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="text-gray-800 hover:text-gray-900 px-2 py-1 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                    <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                    <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" clip-rule="evenodd" />
                                                  </svg>
                                                  </a>
                                                <button onclick="confirmDelete(event, '{{ $user->id }}')" class="text-gray-800 hover:text-gray-900 px-2 py-1 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                                                  </svg>
                                                  </button>
                                            </div>
                                            <form id="deleteForm-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event, userId) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to soft delete this user",
                showCancelButton: true,
                confirmButtonColor: 'gray',
                cancelButtonColor: 'red',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteForm-${userId}`).submit();
                }
            });
        }
    </script>
    


    @if(session('success'))
    <script>
        // Display SweetAlert 2 toast alert for success message
        Swal.fire({
            icon: 'success',
            html: '<strong>{{ session('success') }}</strong>', // Use 'html' instead of 'text' to apply HTML formatting
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            showCloseButton: true, // Added close button
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                // This function is triggered when the alert is opened/displayed
                // It adds event listeners to pause and resume the timer on hover and mouse leave
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    </script>
    @endif
    

</x-app-layout>

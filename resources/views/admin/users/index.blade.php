<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg text-sm">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-2xl">
                            Users ({{ $users->total() }})
                        </div>

                        <form action="{{ route('admin.users.index') }}" method="GET" class="flex items-center space-x-4">
                            <div class="flex-1">
                                <input type="text" name="search" placeholder="Search users..." class="p-2 border border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50 w-full">
                            </div>
                            
                            <div>
                                <select name="usertype" class="p-2 border border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <option value="">All</option>
                                    <option value="admin">Admin</option>
                                    <option value="procurement_officer">Procurement Officer</option>
                                    <option value="procurement_head">Procurement Head</option>
                                    <option value="vendor">Vendor</option>
                                </select>
                            </div>
                        
                            <div>
                                <button type="submit" class="ml-1 bg-gray-700 text-white p-2 rounded-md hover:bg-red-700">Search</button>
                                <a href="{{ route('admin.users.index') }}" class="ml-2 bg-gray-300 text-red-500 p-2 rounded-md hover:bg-gray-200">Reset</a>
                            </div>
                        </form>
                        
                    </div>
                    
                    <!-- User List Table -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Updated At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->usertype }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->created_at->timezone('Asia/Manila')->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->updated_at->timezone('Asia/Manila')->format('Y-m-d') }}</td>    
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">Edit</a>
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn-view">View</a>
                                            <button onclick="confirmDelete('{{ $user->id }}')" class="btn-delete">Delete</button>
                                            <form id="deleteForm_{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $users->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="deletedUsersModal" class="hidden fixed z-10 inset-0 overflow-y-auto flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-75"></div>
    <div class="bg-red-800 p-8 rounded-lg shadow-lg">
        <!-- Modal Content -->
        <div class="text-center">
            <p class="text-lg font-bold text-white mb-4">Are you sure?</p>
            <p class="text-sm text-gray-200">You are about to delete this user.</p>
            <div class="mt-6 flex justify-center">
                <button onclick="cancelDelete()" class="bg-red-800 hover:bg-red-900 text-white font-bold py-2 px-4 rounded mr-4 focus:outline-none focus:ring-2 focus:ring-gray-400">Cancel</button>
                <button onclick="confirmDelete()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-600">Delete</button>
            </div>
        </div>
    </div>
</div>


    @if(session('success'))
    <script>
        // Display SweetAlert 2 toast alert for success message
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            showCloseButton: true,
            closeButtonHtml: '<button>&times;</button>'
        });
    </script>
    @endif

    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this user.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EA1919', // Confirm button color
                cancelButtonColor: '#3B3838', // Cancel button color
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the delete form
                    document.getElementById('deleteForm_' + userId).submit();
                }
            });
        }
    
        function cancelDelete() {
            // Close the modal
            document.getElementById('deletedUsersModal').classList.add('hidden');
        }
    </script>
</x-app-layout>

{{-- views/admin/users/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-2xl">
                            Users ({{ $users->total() }})
                        </div>

                        <form action="{{ route('admin.users.index') }}" method="GET" class="flex items-center">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Search users..." class="p-2 border border-gray-300 rounded-md">
                                <button type="submit" class="ml-2 bg-gray-700 text-white p-2 rounded-md hover:bg-red-700">Search</button>
                            </div>
                            <div class="ml-4">
                                <select name="usertype" class="p-2 border border-gray-300 rounded-md">
                                    <option value="">Select User Type</option>
                                    <option value="admin" @if(request('usertype') == 'admin') selected @endif>Admin</option>
                                    <option value="procurement_officer" @if(request('usertype') == 'procurement_officer') selected @endif>Procurement Officer</option>
                                    <option value="procurement_head" @if(request('usertype') == 'procurement_head') selected @endif>Procurement Head</option>
                                    <option value="vendor" @if(request('usertype') == 'vendor') selected @endif>Vendor</option>
                                </select>
                                <button type="submit" class="ml-2 bg-gray-700 text-white p-2 rounded-md hover:bg-red-700">Filter</button>
                                <a href="{{ route('admin.users.index') }}" class="ml-2 bg--300 text-red-500 p-2 rounded-md hover:bg-gray-200">↻</a>
                            </div>
                        </form>
                    </div>
                    
                    <!-- User List Table -->
                    <div class="mt-6 relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        User Type
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Created At
                                        <a href="{{ route('admin.users.index', ['sort' => 'created_at', 'direction' => $sort === 'created_at' && $direction === 'asc' ? 'desc' : 'asc', 'usertype' => request('usertype'), 'search' => request('search')]) }}" class="text-xs ml-1">
                                            @if($sort === 'created_at' && $direction === 'asc')
                                                &#x25B2;
                                            @elseif($sort === 'created_at' && $direction === 'desc')
                                                &#x25BC;
                                            @endif
                                        </a>
                                    </th>
                                    
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Updated At
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50"></th>
                                    <th class="px-6 py-3 bg-gray-50"></th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $userCount = 0; @endphp
                                @foreach ($users as $user)
                                @php $userCount++; @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $user->id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm leading-5 font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $user->usertype }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $user->created_at->timezone('Asia/Manila')->format('Y-m-d h:i:s A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $user->updated_at->timezone('Asia/Manila')->format('Y-m-d h:i:s A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-red-500 hover:text-red-700">View</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-red-500 hover:text-red-700">Edit</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <!-- Delete Button -->
                                    <form id="deleteForm_{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $user->id }}')" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $users->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deletedUsersModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Soft Deleted Users</h3>
                            <!-- Display soft-deleted users here -->
                            <div id="deletedUsersList" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="closeDeletedUsersModal()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <script>
        // Display SweetAlert success message
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            timer: 2000,
            confirmButtonText: 'OK'
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
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form
                document.getElementById('deleteForm_' + userId).submit();
            }
        });
    }
</script>

</x-app-layout>



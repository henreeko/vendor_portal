{{-- resources/views/livewire/admin/deleted-users.blade.php --}}

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Deleted Users') }}
    </h2>
</x-slot>

<div x-data class="mt-5 ml-5 mr-5 justify-center">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left rtl:text-right text-gray-800 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Usertype</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Deleted At</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deletedUsers as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $user->id }}</td>
                    <td class="px-6 py-4">{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td class="px-6 py-4">{{ $user->usertype }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->deleted_at->format('M-d-Y') }}</td>
                    <td class="px-6 py-4">
                        <button class="text-blue-500" x-on:click="confirmRestore({{ $user->id }})">Restore</button>
                        <br>
                        <button class="text-red-600" x-on:click="confirmDelete({{ $user->id }})">Permanently Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $deletedUsers->links() }}

    <script>
        function confirmRestore(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to restore this user!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('restore', userId);
                }
            });
        }

        function confirmDelete(userId) {
            Swal.fire({
                title: 'Confirm password to delete',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                    autocorrect: 'off'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    Livewire.emit('forceDelete', userId, result.value);
                }
            });
        }
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('showToast', function(type, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
    
            Toast.fire({
                icon: type,
                title: message
            });
        });
    });
    </script>

</div>
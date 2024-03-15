<!-- resources/views/admin/history_logs/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Your content goes here -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Display history logs here -->
                    <h3>History Logs</h3>
                    <!-- Example: Display a table of history logs -->
                    <table>
                        <!-- Table headers -->
                        <tr>
                            <th>Timestamp</th>
                            <th>Action</th>
                            <th>User</th>
                        </tr>
                        <!-- Loop through history logs and display each log -->
                        @foreach ($historyLogs as $log)
                            <tr>
                                <td>{{ $log->timestamp }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->user->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


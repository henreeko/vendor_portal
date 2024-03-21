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
                    <h3 class="text-lg font-semibold mb-4"></h3>
                    <!-- Example: Display a table of history logs -->
                    <div class="overflow-x-auto">
                        <table class="table-auto min-w-full divide-y divide-gray-200">
                            <!-- Table headers -->
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                </tr>
                            </thead>
                            <!-- Loop through history logs and display each log -->
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($historyLogs as $log)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $log->timestamp }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $log->action }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $log->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

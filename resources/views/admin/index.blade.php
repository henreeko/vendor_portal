<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <!-- Welcome message -->
                    <div class="mt-8 text-2xl">
                        Welcome, {{ Auth::user()->first_name }}!
                    </div>
                    <hr class="my-8 border-gray-200">

                    <!-- User Statistics -->
                    <div class="mt-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                                <div class="text-xl font-semibold text-blue-900">Total Users</div>
                                {{-- <div class="text-4xl font-bold text-blue-600">{{ $totalUsers }}</div> --}}
                            </div>
                            <div class="bg-green-100 p-4 rounded-lg shadow-md">
                                <div class="text-xl font-semibold text-green-900">Active Users</div>
                                {{-- <div class="text-4xl font-bold text-green-600">{{ $activeUsers }}</div> --}}
                            </div>
                            <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                                <div class="text-xl font-semibold text-yellow-900">Users Registered Today</div>
                                {{-- <div class="text-4xl font-bold text-yellow-600">{{ $usersRegisteredToday }}</div> --}}
                            </div>
                        </div>
                    </div>
                    <hr class="my-8 border-gray-200">

                    <!-- Charts.js Example -->
                    <div class="mt-8">
                        <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                    <hr class="my-8 border-gray-200">

                    <!-- History Logs Table TEST -->
                    <div class="mt-8">
                        <div class="bg-white shadow-md rounded my-6">
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Action</th>
                                        <th class="py-3 px-6 text-left">User</th>
                                        <th class="py-3 px-6 text-center">Date</th>
                                        <th class="py-3 px-6 text-center">Time</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @php
                                        $historyLogs = [
                                            ['action' => 'Logged in', 'user' => 'John Doe', 'date' => '2024-03-10', 'time' => '09:30 AM'],
                                            ['action' => 'Updated profile', 'user' => 'Jane Smith', 'date' => '2024-03-11', 'time' => '02:45 PM'],
                                            ['action' => 'Deleted post', 'user' => 'Admin', 'date' => '2024-03-12', 'time' => '11:20 AM'],
                                            ['action' => 'Added new user', 'user' => 'Super Admin', 'date' => '2024-03-13', 'time' => '04:10 PM'],
                                            // Add more fictional data as needed
                                        ];
                                    @endphp

                                    @foreach ($historyLogs as $log)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $log['action'] }}</td>
                                            <td class="py-3 px-6 text-left">{{ $log['user'] }}</td>
                                            <td class="py-3 px-6 text-center">{{ $log['date'] }}</td>
                                            <td class="py-3 px-6 text-center">{{ $log['time'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Charts.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script to initialize and configure the chart -->
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Sample Data',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>

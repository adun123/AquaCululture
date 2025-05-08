<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Device Monitoring') }}: {{ $device->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded">
                            <h3 class="font-bold">Device Code</h3>
                            <p>{{ $device->device_code }}</p>
                        </div>
                        <div class="bg-green-100 dark:bg-green-900 p-4 rounded">
                            <h3 class="font-bold">Location</h3>
                            <p>{{ $device->location ?? 'Not set' }}</p>
                        </div>
                        <div class="bg-yellow-100 dark:bg-yellow-900 p-4 rounded">
                            <h3 class="font-bold">Description</h3>
                            <p>{{ $device->description ?? 'No description' }}</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mb-4">Latest Readings</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Temperature (°C)</th>
                                    <th>pH</th>
                                    <th>DO (mg/L)</th>
                                    <th>Risk Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($readings as $reading)
                                <tr>
                                    <td>{{ $reading->reading_time }}</td>
                                    <td>{{ $reading->temperature }}</td>
                                    <td>{{ $reading->ph }}</td>
                                    <td>{{ $reading->dissolved_oxygen }}</td>
                                    <td>{{ $reading->risk_level }}</td>
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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Devices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('devices.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add New Device
                    </a>

                    <div class="mt-6">
                        @if($devices->isEmpty())
                            <p>No devices found. Add your first device.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Device Code</th>
                                            <th>Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($devices as $device)
                                        <tr>
                                            <td>{{ $device->name }}</td>
                                            <td>{{ $device->device_code }}</td>
                                            <td>{{ $device->location }}</td>
                                            <td>
                                                <a href="{{ route('devices.show', $device) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
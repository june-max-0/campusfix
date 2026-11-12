<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <p class="mb-6 text-gray-700">
                Welcome back, <strong>{{ auth()->user()->name }}</strong>.
                @if(auth()->user()->role === 'admin')
                    You are logged in as an administrator and can see all requests.
                @endif
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-gray-500">
                    <p class="text-sm text-gray-500">Total requests</p>
                    <p class="text-3xl font-bold">{{ $counts['total'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500">Pending</p>
                    <p class="text-3xl font-bold">{{ $counts['pending'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500">In progress</p>
                    <p class="text-3xl font-bold">{{ $counts['in_progress'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Completed</p>
                    <p class="text-3xl font-bold">{{ $counts['completed'] }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-lg">Recent requests</h3>
                    <a href="{{ route('requests.index') }}" class="text-blue-600 text-sm hover:underline">View all</a>
                </div>

                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-3 py-2">Title</th>
                            <th class="px-3 py-2">Category</th>
                            <th class="px-3 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent as $item)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $item->title }}</td>
                                <td class="px-3 py-2">{{ $item->category->name }}</td>
                                <td class="px-3 py-2">{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 py-6 text-center text-gray-500">No requests yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
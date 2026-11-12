<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Maintenance Requests</h2>
    </x-slot>

    @php
        $isAdmin = auth()->user()->role === 'admin';
        $colors = [
            'pending'     => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'completed'   => 'bg-green-100 text-green-800',
        ];
    @endphp

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-wrap justify-between items-center gap-3 mb-4">
                    <form method="GET" action="{{ route('requests.index') }}" class="flex flex-wrap gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search title, description, location"
                               class="border-gray-300 rounded-md text-sm">
                        <select name="status" class="border-gray-300 rounded-md text-sm">
                            <option value="">All status</option>
                            @foreach(['pending', 'in_progress', 'completed'] as $s)
                                <option value="{{ $s }}" @selected(request('status') === $s)>
                                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">Search</button>
                    </form>

                    <a href="{{ route('requests.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm">+ New Request</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-3 py-2">Title</th>
                                <th class="px-3 py-2">Category</th>
                                <th class="px-3 py-2">Location</th>
                                <th class="px-3 py-2">Priority</th>
                                <th class="px-3 py-2">Status</th>
                                @if($isAdmin)
                                    <th class="px-3 py-2">Submitted by</th>
                                @endif
                                <th class="px-3 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $item)
                                <tr class="border-t">
                                    <td class="px-3 py-2">{{ $item->title }}</td>
                                    <td class="px-3 py-2">{{ $item->category->name }}</td>
                                    <td class="px-3 py-2">{{ $item->location }}</td>
                                    <td class="px-3 py-2">{{ ucfirst($item->priority) }}</td>
                                    <td class="px-3 py-2">
                                        <span class="px-2 py-1 rounded text-xs {{ $colors[$item->status] ?? '' }}">
                                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                        </span>
                                    </td>
                                    @if($isAdmin)
                                        <td class="px-3 py-2">{{ $item->user->name }}</td>
                                    @endif
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <a href="{{ route('requests.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form method="POST" action="{{ route('requests.destroy', $item) }}"
                                              class="inline ml-2"
                                              onsubmit="return confirm('Delete this request?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-3 py-6 text-center text-gray-500">No requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $requests->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
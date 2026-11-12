<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Feedback</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-3 py-2">From</th>
                            <th class="px-3 py-2">Subject</th>
                            <th class="px-3 py-2">Rating</th>
                            <th class="px-3 py-2">Message</th>
                            <th class="px-3 py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feedbacks as $item)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $item->user->name }}</td>
                                <td class="px-3 py-2">{{ $item->subject }}</td>
                                <td class="px-3 py-2">{{ $item->rating }} / 5</td>
                                <td class="px-3 py-2">{{ $item->message }}</td>
                                <td class="px-3 py-2">{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-3 py-6 text-center text-gray-500">No feedback yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $feedbacks->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
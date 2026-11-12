<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Request</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('requests.update', $serviceRequest) }}" onsubmit="return validateRequestForm()">
                    @csrf
                    @method('PUT')
                    @include('requests._form')

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm">Save Changes</button>
                        <a href="{{ route('requests.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
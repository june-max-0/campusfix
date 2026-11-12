<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Feedback</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-600 mb-4">Tell us how we can improve the maintenance service.</p>

                <form method="POST" action="{{ route('feedback.store') }}" onsubmit="return validateFeedback()">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('subject') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Rating</label>
                        <select name="rating" id="rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Select rating --</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }} / 5</option>
                            @endfor
                        </select>
                        @error('rating') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" id="message" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm">Send Feedback</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateFeedback() {
            const subject = document.getElementById('subject').value.trim();
            const rating = document.getElementById('rating').value;
            const message = document.getElementById('message').value.trim();

            if (subject === '') {
                alert('Please enter a subject.');
                return false;
            }
            if (rating === '') {
                alert('Please select a rating.');
                return false;
            }
            if (message.length < 10) {
                alert('Message must be at least 10 characters.');
                return false;
            }
            return true;
        }
    </script>
</x-app-layout>
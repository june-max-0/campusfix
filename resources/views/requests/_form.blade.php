@php
    $isAdmin = auth()->user()->role === 'admin';
    $inputClass = 'mt-1 block w-full border-gray-300 rounded-md shadow-sm';
@endphp

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Category</label>
    <select name="category_id" id="category_id" class="{{ $inputClass }}">
        <option value="">-- Select category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $serviceRequest->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Title</label>
    <input type="text" name="title" id="title" class="{{ $inputClass }}"
           value="{{ old('title', $serviceRequest->title ?? '') }}">
    @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Description</label>
    <textarea name="description" id="description" rows="4"
              class="{{ $inputClass }}">{{ old('description', $serviceRequest->description ?? '') }}</textarea>
    @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Location (e.g. Block A, Room 204)</label>
    <input type="text" name="location" id="location" class="{{ $inputClass }}"
           value="{{ old('location', $serviceRequest->location ?? '') }}">
    @error('location') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Priority</label>
    <select name="priority" id="priority" class="{{ $inputClass }}">
        @foreach(['low', 'medium', 'high'] as $p)
            <option value="{{ $p }}"
                @selected(old('priority', $serviceRequest->priority ?? 'medium') === $p)>
                {{ ucfirst($p) }}
            </option>
        @endforeach
    </select>
</div>

@if($isAdmin && isset($serviceRequest))
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status" class="{{ $inputClass }}">
            @foreach(['pending', 'in_progress', 'completed'] as $s)
                <option value="{{ $s }}"
                    @selected(old('status', $serviceRequest->status) === $s)>
                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                </option>
            @endforeach
        </select>
    </div>
@endif

<script>
    // Client-side validation: runs in the browser before the form is sent
    function validateRequestForm() {
        const category = document.getElementById('category_id').value;
        const title = document.getElementById('title').value.trim();
        const description = document.getElementById('description').value.trim();
        const location = document.getElementById('location').value.trim();

        if (category === '') {
            alert('Please select a category.');
            return false;
        }
        if (title.length < 5) {
            alert('Title must be at least 5 characters.');
            return false;
        }
        if (description.length < 10) {
            alert('Please describe the problem in at least 10 characters.');
            return false;
        }
        if (location === '') {
            alert('Please enter the location.');
            return false;
        }
        return true;
    }
</script>
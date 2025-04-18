@extends('dashboard')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
  <h2 class="text-2xl font-semibold mb-4">Create Consulting Section</h2>

  <!-- Display Success Message -->
  @if(session('success'))
  <div class="bg-green-500 text-white p-3 rounded mb-4">
    {{ session('success') }}
  </div>
  @endif

  @php
  $options = ["General Inquiry", "Project Estimate", "Support", "Others"];
  @endphp

  <!-- Form -->
  <form action="{{ route('consulting.post') }}" method="POST">
    @csrf

    <!-- Title -->
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold">Title</label>
      <input type="text" name="title" value="{{ $formData->title ?? '' }}" class="w-full p-2 border rounded" required>
    </div>

    <!-- Description -->
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold">Description</label>
      <textarea name="description" class="w-full p-2 border rounded" required>{{ $formData->description ?? '' }}</textarea>
    </div>

    <!-- Point 1 -->
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold">Point 1 - Title</label>
      <input type="text" name="points[0][title]" value="{{ $formData->points[0]['title'] ?? '' }}" class="w-full p-2 border rounded" required>

      <label class="block text-gray-700 font-semibold mt-2">Point 1 - Description</label>
      <textarea name="points[0][description]" class="w-full p-2 border rounded" required>{{ $formData->points[0]['description'] ?? '' }}</textarea>
    </div>

    <!-- Point 2 -->
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold">Point 2 - Title</label>
      <input type="text" name="points[1][title]" value="{{ $formData->points[1]['title'] ?? '' }}" class="w-full p-2 border rounded" required>

      <label class="block text-gray-700 font-semibold mt-2">Point 2 - Description</label>
      <textarea name="points[1][description]" class="w-full p-2 border rounded" required>{{ $formData->points[1]['description'] ?? '' }}</textarea>
    </div>

    <!-- Dropdown Options -->
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold">Dropdown Options</label>

      <div class="flex flex-col space-y-2">
        @foreach($options as $option)
        <label class="inline-flex items-center">
          <input type="checkbox" name="dropdown_options[]" value="{{ $option }}"
            {{ in_array($option, $formData->dropdown_options ?? []) ? 'checked' : '' }}
            class="mr-2">
          {{ str_replace('-', ' ', $option) }}
        </label>
        @endforeach
      </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
      Submit
    </button>
  </form>
</div>
@endsection
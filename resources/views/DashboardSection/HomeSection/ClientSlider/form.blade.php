@extends('dashboard')

@section('content')
<div class="container mx-auto p-6">
  <h2 class="text-2xl font-bold mb-4">Add/Edit Development Image</h2>

  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
  </div>
  @endif

  <form
    action="{{ isset($devImageData) ? route('ourdevelopment.image.update', $devImageData->id) : route('ourdevelopment.image.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="bg-white p-6 rounded-lg shadow-md">
    @csrf

    @if(isset($devImageData))
    @method('PUT')
    @endif

    {{-- Section ID --}}
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Section ID</label>
      <input type="text" name="section_id"
        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        value="{{ $devImageData->section_id ?? '' }}"
        required>
    </div>

    {{-- Image Upload --}}
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Upload Image</label>
      <input type="file" name="image"
        class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
        {{ isset($devImageData) ? '' : 'required' }}>
    </div>

    {{-- Preview if editing --}}
    @if(isset($devImageData) && $devImageData->image_path)
    <div class="mb-4">
      <p class="text-gray-700 font-semibold mb-2">Current Image:</p>
      <img src="{{ $devImageData->image_path }}" alt="{{ $devImageData->alt_text }}" class="w-32 h-auto rounded border">
    </div>
    @endif

    {{-- Alt Text --}}
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Alt Text</label>
      <input type="text" name="alt_text"
        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        value="{{ $devImageData->alt_text ?? '' }}"
        required>
    </div>

    {{-- Submit --}}
    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
      {{ isset($devImageData) ? 'Update Image' : 'Upload Image' }}
    </button>
  </form>
</div>
@endsection
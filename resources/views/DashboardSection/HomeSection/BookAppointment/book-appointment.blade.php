@extends('dashboard')
@section('content')

<div class="mx-auto p-6 bg-white rounded-lg shadow">
  <h2 class="text-2xl font-semibold mb-6">Book Appointment Section</h2>

  @if(session('success'))
  <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
  @endif

  <form action="{{ route('book.appointment') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div>
      <label for="title" class="block font-medium">Title</label>
      <input type="text" name="title" id="title" value="{{ old('title', $data->title ?? '') }}" class="w-full mt-1 border border-gray-300 p-2 rounded">
      @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
      <label for="description" class="block font-medium">Description</label>
      <textarea name="description" id="description" rows="4" class="w-full mt-1 border border-gray-300 p-2 rounded">{{ old('description', $data->description ?? '') }}</textarea>
      @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
      <label for="image" class="block font-medium">Image (optional)</label>
      <input type="file" name="image" id="image" class="mt-1">
      @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

      @if(!empty($data->image))
      <div class="mt-3">
        <p class="text-sm mb-1">Current Image:</p>
        <img src="{{ $data->image }}" alt="Current" class="w-48 rounded shadow">
      </div>
      @endif
    </div>

    <button type="submit" class="btn-secondary font-semibold py-3 px-6 rounded-lg bg-blue-600 text-white">
      Save Appointment Content
    </button>
  </form>
</div>

@endsection
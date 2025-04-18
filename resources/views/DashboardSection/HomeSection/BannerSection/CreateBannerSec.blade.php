@extends('dashboard')

@section('content')
<div class=" ">
  <h2 class="text-2xl font-bold mb-6">Add Banner</h2>
  <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg p-6">
    @csrf

    <div class="mb-4">
      <label for="titleParts" class="block text-gray-700 font-semibold mb-2">Title</label>
      <input type="text" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" id="titleParts" name="titleParts" value="{{ $bannerSecData->titleParts ?? '' }}" required>
    </div>

    <div class="mb-4">
      <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
      <textarea class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" id="description" name="description" required>{{ $bannerSecData->description ?? '' }}</textarea>
    </div>

    <div class="mb-4">
      <label for="buttonText" class="block text-gray-700 font-semibold mb-2">Button Text</label>
      <input type="text" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" id="buttonText" name="buttonText" value="{{ $bannerSecData->buttonText ?? '' }}" required>
    </div>

    <div class="mb-4">
      <label for="backgroundImage" class="block text-gray-700 font-semibold mb-2">Background Image</label>
      <input type="file" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" id="backgroundImage" name="backgroundImage" accept="image/*">

      @if (!empty($bannerSecData->backgroundImage))
      <div class="mt-3">
        <p class="text-sm text-gray-600">Current Image:</p>
        <img src="{{ asset('storage/' . $bannerSecData->backgroundImage) }}" class="mt-2 w-32 h-20 object-cover rounded-lg border">
      </div>
      @endif

    </div>

    <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-300">Submit</button>
  </form>
</div>
@endsection
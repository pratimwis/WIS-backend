@extends('dashboard')

@section('content')
<div class="container mx-auto p-6">
  <h2 class="text-2xl font-bold mb-4">{{ isset($sliders) ? 'Edit Client Image' : 'Add Client Image' }}</h2>

  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
  </div>
  @endif

  <form 
    action="{{ isset($sliders) ? route('clientSlider.edit', $sliders->id) : route('clientSlider.create') }}" 
    method="POST" 
    enctype="multipart/form-data"
    class="bg-white p-6 rounded-lg shadow-md">
    @csrf

   

    {{-- Alt Text --}}
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Alt Text</label>
      <input type="text" name="alt"
        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        value="{{ $sliders->alt ?? '' }}"
        required>
    </div>

    {{-- Image Upload --}}
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Upload Image</label>
      <input type="file" name="image_path"
        class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
        {{ isset($sliders) ? '' : 'required' }}>
    </div>

    {{-- Preview Existing Image --}}
    @if(isset($sliders) && $sliders->image_path)
    <div class="mb-4">
      <p class="text-gray-700 font-semibold mb-2">Current Image:</p>
      <img src="{{ config('app.url') . '/storage' . '/' .$sliders->image_path }}" alt="{{ $sliders->alt }}" class="w-32 h-auto rounded border">
    </div>
    @endif

    {{-- Submit --}}
    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
      {{ isset($sliders) ? 'Update Image' : 'Upload Image' }}
    </button>
  </form>
</div>
@endsection

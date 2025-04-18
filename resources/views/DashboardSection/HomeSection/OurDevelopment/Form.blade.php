@extends('dashboard')

@section('content')
<div class="container mx-auto p-6">
  <h2 class="text-2xl font-bold mb-4">Add Our Development Section</h2>

  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
  </div>
  @endif

  <form
    action="{{ isset($ourDevelopmentData) ? route('ourdevelopment.put', $ourDevelopmentData->id) : route('ourdevelopment.post') }}"
    method="POST"
    class="bg-white p-6 rounded-lg shadow-md">
    @csrf

    @if(isset($ourDevelopmentData))
    @method('PUT')
    @endif

    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Section ID</label>
      <input type="text" name="section_id"
        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $ourDevelopmentData->section_id??' '}}"
        required>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Title</label>
      <input type="text" name="title"
        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $ourDevelopmentData->title??' '}}"
        required>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Background Color</label>
      <input type="color" name="bg_color"
        class="w-full border border-gray-300 rounded-lg p-2 h-10 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $ourDevelopmentData->bg_color??' '}}"
        required>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Content</label>
      <textarea name="content" rows="4"
        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        required>{{$ourDevelopmentData->content??' '}}</textarea>
    </div>

    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
      Submit
    </button>
  </form>
</div>
@endsection
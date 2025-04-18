@extends('dashboard')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
  <h2 class="text-2xl font-semibold">Add Carousel Items</h2>
  <form action="{{ route('carousel.post') }}" method="POST">
    @csrf
    <div class="mb-4">
      <label for="title" class="block text-sm font-medium text-gray-700 p-2">
        Add Items (Separate with commas)
      </label>
      <input type="text" id="title" name="title"
        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:ring-2"
        placeholder="Develop, Promote, Design, Innovate, Strategize"
        value="{{ $carouselItems->pluck('title')->implode(', ') }}" required/>

    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
      Submit
    </button>
  </form>
</div>
@endsection
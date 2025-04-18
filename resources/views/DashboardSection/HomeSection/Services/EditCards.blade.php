@extends('dashboard')

@section('content')
<div class="container mx-auto p-6">
  <h2 class="text-2xl font-bold mb-4">
    @if(isset($card))
    Update Expertise Card
    @else
    Add Expertise Card
    @endif
  </h2>

  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
  </div>
  @endif

  <form action="{{ isset($card) ? route('update.serviceCard.data', $card->id) : route('post.section.cards.data') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf
    @if(isset($card))
    @method('PUT')
    @endif
    <div>
      <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Card Icon (Image)</label>
      <input type="file" name="icon" id="icon" required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
      @if (!empty($card->icon))
      <img src="{{ $card->icon }}" alt="{{ $card->alt ?? '' }}" class="mt-2 w-40 rounded shadow">
      @endif
    </div>
    <div>
      <label for="card_title" class="block text-sm font-medium text-gray-700 mb-1">Card Title</label>
      <input type="text" name="title" id="card_title" value="{{$card->title ?? ''}}" required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-green-500 focus:border-green-500">
    </div>

    <div>
      <label for="card_description" class="block text-sm font-medium text-gray-700 mb-1">Card Description</label>
      <textarea name="description" id="card_description" rows="4" required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-green-500 focus:border-green-500">{{$card->description ?? ''}}</textarea>
    </div>

    <div>
      <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Background Image</label>
      <input type="file" name="image" id="image" required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
      @if (!empty($card->image))
      <img src="{{ $card->image }}" alt="{{ $card->alt ?? '' }}" class="mt-2 w-40 rounded shadow">
      @endif
    </div>

    <!-- <div>
      <label for="card_alt" class="block text-sm font-medium text-gray-700 mb-1">Icon Alt Text</label>
      <input type="text" name="alt" id="card_alt" value="{{$card->alt??''}}" required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-green-500 focus:border-green-500">
    </div> -->

    <button type="submit"
      class="mt-4 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition duration-200">
      Add Service Card
    </button>
  </form>
</div>
@endsection
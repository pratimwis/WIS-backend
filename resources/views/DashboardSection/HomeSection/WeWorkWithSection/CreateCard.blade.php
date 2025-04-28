@extends('dashboard')

@section('content')
<div class="bg-white p-6 shadow-md rounded-lg border">
  <h2 class="text-2xl font-bold mb-4">
    @if(isset($card))
    Update Cooperating Partners Card
    @else
    Add Cooperating Partners Card
    @endif
  </h2>

  <form action="{{ isset($card) ? route('update.weworkwithcard', $card->id) : route('post.weworkwithcard') }}"
    method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf

    {{-- Tab Name --}}
    <div>
      <label class="block font-semibold">Tab Name</label>
      <input type="text" name="tab_name" class="w-full border p-2 rounded" value="{{ $card->tab_name ?? '' }}" required>
    </div>
    {{-- Title --}}
    <div>
      <label class="block font-semibold">Title</label>
      <input type="text" name="title" class="w-full border p-2 rounded" value="{{ $card->title ?? '' }}" required>
    </div>

    {{-- Description --}}
    <div>
      <label class="block font-semibold">Description</label>
      <textarea name="description" class="w-full border p-2 rounded" rows="4">{{ $card->description ?? '' }}</textarea>
    </div>

    {{-- Features --}}
    <div>
      <label class="block font-semibold">Features</label>
      <div class="mt-2">
        <input
          type="text"
          name="features"
          class="w-full border p-2 rounded"
          placeholder="Enter features comma-separated"
          value="{{ isset($card->features) ? implode(',', $card->features) : '' }}">
      </div>
    </div>


    {{-- Image --}}
    <div>
      <label class="block font-semibold">Image</label>
      <input type="file" name="image" class="w-full border p-2 rounded" accept="image/*">
      @if (!empty($card->image))
      <div class="mt-2">
        <img src="{{ config('app.url') . '/storage' . '/' .$card->image }}" alt="{{ $card->image_alt }}" class="h-12 w-20">
      </div>
      @endif
    </div>

    <div>
      <label class="block font-semibold">Image Alt</label>
      <input type="text" name="image_alt" class="w-full border p-2 rounded" value="{{ $card->image_alt ?? '' }}" required>
    </div>
    {{-- Icon Image --}}
    <div>
      <label class="block font-semibold">Icon Image</label>
      <input type="file" name="icon" class="w-full border p-2 rounded" accept="image/*">
      @if (!empty($card->icon))
      <div class="mt-2">
        <img src="{{ config('app.url') . '/storage' . '/' .$card->icon }}" alt="icon_alt" class="h-12 w-20">
      </div>
      @endif
    </div>
    <div>
      <label class="block font-semibold">Icon Alt</label>
      <input type="text" name="icon_alt" class="w-full border p-2 rounded" value="{{ $card->icon_alt ?? '' }}" required>
    </div>




    {{-- Submit Button --}}
    <div>
      <button type="submit" class="btn-secondary py-2 px-6 rounded-lg text-white bg-green-600">
        {{ isset($card) ? 'Update' : 'Add' }} Cooperating Partners Card
      </button>
    </div>
  </form>

</div>
@endsection
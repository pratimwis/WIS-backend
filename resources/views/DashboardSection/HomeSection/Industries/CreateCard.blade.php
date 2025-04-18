@extends('dashboard')

@section('content')
<div class="bg-white p-6 shadow-md rounded-lg border">
  <h2 class="text-xl font-bold mb-4">Add Industry Card</h2>

  <form action="{{ isset($card) ? route('industries.update', $card->id) : route('industries.card.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf
    <div>
      <label class="block font-semibold">Card Title</label>
      <input type="text" name="title" class="w-full border p-2 rounded" value="{{$card->title??''}}" required>
    </div>

    <div>
      <label class="block font-semibold">Card Description</label>
      <textarea name="description" class="w-full border p-2 rounded">{{$card->description??''}}</textarea>
    </div>
    <div>
      <label class="block font-semibold">Icon Image</label>
      <input type="file" name="icon" class="w-full border p-2 rounded" accept="image/*" required>
      @if (!empty($card->icon))
      <img src="{{$card->icon??''}}" alt="tcs-icon" class="h-12 w-20">
      @endif
    </div>


    <button type="submit" class="btn-secondary py-2 px-6 rounded-lg text-white bg-green-600">
      Add Industry Card
    </button>
  </form>
</div>
@endsection
@extends('dashboard')

@section('content')
<div class="max-w-4xl mx-auto ">
  <h2 class="text-2xl font-bold mb-6">Set Who We are Section</h2>

  <form action="{{ route('postHomewhoweare.create') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <div>
      <label class="block font-semibold">Title</label>
      <input type="text" name="title" class="w-full border p-2 rounded" value="{{$data->title?? '' }}" required>
    </div>

    <div>
      <label class="block font-semibold">Subtitle</label>
      <input type="text" name="subtitle" class="w-full border p-2 rounded" value="{{$data->subtitle?? '' }}">
    </div>

    <div>
      <label class="block font-semibold">Description</label>
      <textarea name="description" class="border py-4 p-4 h-full w-full rounded" required>{{$data->description?? '' }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="block font-semibold">Stat 1 Label</label>
        <input type="text" name="stat_1_label" class="w-full border p-2 rounded" value="{{$data->stat_1_label ?? '' }}" required>
        <label class="block font-semibold mt-2">Stat 1 Value</label>
        <input type="number" name="stat_1_value" class="w-full border p-2 rounded" value="{{$data->stat_1_value ?? '' }}" required>
      </div>

      <div>
        <label class="block font-semibold">Stat 2 Label</label>
        <input type="text" name="stat_2_label" class="w-full border p-2 rounded" value="{{$data->stat_2_label?? '' }}" required>
        <label class="block font-semibold mt-2">Stat 2 Value</label>
        <input type="number" name="stat_2_value" class="w-full border p-2 rounded" value="{{$data->stat_2_value?? '' }}" required>
      </div>

      <div>
        <label class="block font-semibold">Stat 3 Label</label>
        <input type="text" name="stat_3_label" class="w-full border p-2 rounded" value="{{$data->stat_3_label?? '' }}" required>
        <label class="block font-semibold mt-2">Stat 3 Value</label>
        <input type="number" name="stat_3_value" class="w-full border p-2 rounded" value="{{$data->stat_3_value?? '' }}" required>
      </div>
    </div>

    <button type="submit" class="btn-secondary font-semibold py-3 px-6 rounded-lg mt-6 bg-blue-600 text-white">Submit</button>
  </form>

  <div id="responseMessage" class="mt-4 text-green-600 font-semibold hidden"></div>
</div>


@endsection
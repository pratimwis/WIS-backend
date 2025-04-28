@extends('dashboard')

@section('content')
<div class="max-w-5xl mx-auto mt-10 space-y-12">

  {{-- Section 1: Title & Description --}}
  <div class="bg-white p-6 shadow-md rounded-lg border">
    <h2 class="text-xl font-bold mb-4">Industries Title & Description</h2>

    <form action="{{ route('industries.title_des.store') }}" method="POST" class="space-y-6">
      @csrf
      <div>
        <label class="block font-semibold">Title</label>
        <input type="text" name="title" class="w-full border p-2 rounded" value="{{$titleDes->title ?? ''}}" required>
      </div>

      <div>
        <label class="block font-semibold">Description</label>
        <textarea name="description" class="w-full border p-2 rounded" required>{{$titleDes->description ?? ''}}</textarea>
      </div>

      <button type="submit" class="btn-secondary py-2 px-6 rounded-lg text-white bg-blue-600">
        Save Title & Description
      </button>
    </form>
  </div>

  {{-- Section 2: Industry Cards --}}



  <section class="mt-12 bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-bold text-gray-800">Industries Cards</h2>
      <a href="{{ route('industries.create-card') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
        + Create New Industries Item
      </a>
    </div>


    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Icon</th>
            <th class="px-4 py-3">Icon Alt</th>
            <th class="px-4 py-3">Title</th>
            <th class="px-4 py-3">Description</th>

            <th class="px-4 py-3">Created At</th>
            <th class="px-4 py-3">Updated At</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach($cardData as $card)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-2 text-gray-700">{{ $card->id }}</td>
            <td class="px-4 py-2">
              <img src="{{ config('app.url') . '/storage' . '/' .$card->icon }}" alt="{{ $card->alt }}" class="w-12 h-12 rounded object-contain border">
            </td> 
            <td class="px-4 py-2 text-gray-500">{{ $card->alt }}</td>
            <td class="px-4 py-2 text-gray-900 font-medium">{{ $card->title }}</td>
            <td class="px-4 py-2 text-gray-700 truncate max-w-0 whitespace-nowrap overflow-hidden">
              {{ $card->description }}
            </td>



            <!-- <td class="px-4 py-2 text-gray-700">{{ $card->alt }}</td> -->
            <td class="px-4 py-2 text-gray-500">{{ \Carbon\Carbon::parse($card->created_at)->format('d M Y') }}</td>
            <td class="px-4 py-2 text-gray-500">{{ \Carbon\Carbon::parse($card->updated_at)->format('d M Y') }}</td>
            <td class="px-4 py-2 text-right space-x-2">
              <a href="{{ route('industries.edit-industries-card', $card->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white text-xs font-semibold rounded hover:bg-yellow-500">Edit</a>
              <form action="{{ route('industries.delete.card', $card->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded hover:bg-red-600">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>


</div>
@endsection
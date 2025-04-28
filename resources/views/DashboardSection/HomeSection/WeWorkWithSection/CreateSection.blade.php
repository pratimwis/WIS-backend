@extends('dashboard')

@section('content')
<div class="max-w-6xl mx-auto mt-10 space-y-12">

  {{-- Section 1: Title & Description --}}
  <div class="bg-white p-6 shadow-md rounded-lg border">
    <h2 class="text-xl font-bold mb-4">We Work With Title & Description</h2>

    <form action="{{ route('create-titleDes.weworkwith') }}" method="POST" class="space-y-6">
      @csrf
      <div>
        <label class="block font-semibold mb-1">Title</label>
        <input type="text" name="title" class="w-full border p-2 rounded" value="{{ $WeWorkTitle_des->title ?? '' }}" required>
      </div>

      <div>
        <label class="block font-semibold mb-1">Description</label>
        <textarea name="description" class="w-full border p-2 rounded" rows="4" required>{{ $WeWorkTitle_des->description ?? '' }}</textarea>
      </div>

      <button type="submit" class="btn-secondary py-2 px-6 rounded-lg text-white bg-blue-600">
        Save Title & Description
      </button>
    </form>
  </div>

  {{-- Section 2: Industry Cards --}}
  <section class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-bold text-gray-800">We Work With Cards</h2>
      <a href="{{ route('WeWorkWith.create-card') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
        + Create New Item
      </a>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Tab Name</th>
            <th class="px-4 py-3">Title</th>
            <th class="px-4 py-3">Description</th>
            <th class="px-4 py-3">Features</th>
            <th class="px-4 py-3">Image</th>

            <th class="px-4 py-3">Icon</th>



            <th class="px-4 py-3">Created</th>
            <th class="px-4 py-3">Updated</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach($cardData_weWork as $card)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 text-gray-700">{{ $card->id }}</td>
            <td class="px-4 py-3 text-gray-700">{{ $card->tab_name }}</td>
            <td class="px-4 py-3 font-medium text-gray-900">{{ $card->title }}</td>
            <td class="px-4 py-3 text-gray-700 max-w-sm whitespace-normal">{{ $card->description }}</td>
            {{-- Features --}}
            <td class="px-4 py-3">
              <ul class="list-disc list-inside text-gray-700 space-y-1">
                @foreach($card->features as $feature)
                <li>{{ $feature }}</li>
                @endforeach
              </ul>
            </td>
            {{-- Image --}}
            <td class="px-4 py-3">
              <img src="{{ config('app.url') . '/storage' . '/' .$card->image }}" alt="{{ $card->image_alt }}" class="w-10 h-10 object-contain border rounded">
            </td>
            {{-- Icon --}}
            <td class="px-4 py-3">
              <img src="{{ config('app.url') . '/storage' . '/' .$card->icon }}" alt="{{ $card->icon_alt }}" class="w-10 h-10 object-contain border rounded">
            </td>






            <td class="px-4 py-3 text-gray-500">{{ \Carbon\Carbon::parse($card->created_at)->format('d M Y') }}</td>
            <td class="px-4 py-3 text-gray-500">{{ \Carbon\Carbon::parse($card->updated_at)->format('d M Y') }}</td>

            {{-- Actions --}}
            <td class="px-4 py-3 text-right space-x-2">
              <a href="{{ route('UpdateWeWorkWithsCard', $card->id) }}"
                class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-xs font-semibold rounded hover:bg-yellow-600">
                Edit
              </a>
              <form action="{{ route('delete.weworkwith.card', $card->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded hover:bg-red-600">
                  Delete
                </button>
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
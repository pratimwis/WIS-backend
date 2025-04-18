@extends('dashboard')

@section('content')


{{-- Section 1: Expertise Main Content --}}
<div x-data="{ showForm: false }" class="bg-white shadow-md rounded-xl p-6 mb-10">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
    <div>
      <h2 class="text-xl font-bold text-gray-800 mb-1">Services Section</h2>
      @if (!empty($titleDes->title) || !empty($titleDes->description))
      <div class="bg-gray-50 p-4 rounded-lg shadow-inner border border-gray-200 mt-2">
        <p class="text-sm text-gray-600"><span class="font-semibold">Title:</span> {{ $titleDes->title ?? 'N/A' }}</p>
        <p class="text-sm text-gray-600 mt-1"><span class="font-semibold">Description:</span> {{ $titleDes->description ?? 'N/A' }}</p>
        <p class="text-sm text-gray-600 mt-1"><span class="font-semibold">Services:</span> {{ implode(', ', $titleDes->services ?? []) }}</p>
      </div>
      @else
      <p class="text-sm text-gray-500 italic">No titleDes data added yet.</p>
      @endif
    </div>

    <button
      @click="showForm = !showForm"
      type="button"
      class="self-start md:self-auto bg-blue-500 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition">
      <span x-text="showForm ? 'Close' : ' Update'"></span>
    </button>
  </div>


  <form
    x-show="showForm"
    x-transition
    action="{{ route('post.second.service.data') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-5">
    @csrf

    <div>
      <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
      <input type="text" name="title" id="title" value="{{ $titleDes->title ?? '' }}" required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div>
      <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
      <textarea name="description" id="description" rows="4" required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $titleDes->description ?? '' }}</textarea>
    </div>
    <div>
      <label for="services[]" class="block text-sm font-medium text-gray-700 mb-1">Services (one per line)</label>
      <textarea name="services[]" rows="3"
        class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ implode("\n", $titleDes->services ?? []) }}</textarea>
    </div>
    <button type="submit"
      class="mt-4 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition duration-200">
      Save Section
    </button>
  </form>
</div>

{{-- Section 2: Expertise Card Content --}}

<!-- Cards table -->
<section class="mt-12 bg-white rounded-lg shadow p-6">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-800">Services Cards</h2>
    <a href="{{ route('service.create-service-card') }}"
      class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
      + Create New Services Item
    </a>
  </div>


  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
      <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
        <tr>
          <th class="px-4 py-3">ID</th>
          <th class="px-4 py-3">Icon</th>
          <th class="px-4 py-3">Title</th>
          <th class="px-4 py-3">Description</th>
          <th class="px-4 py-3">Image</th>
          <th class="px-4 py-3">Created At</th>
          <th class="px-4 py-3">Updated At</th>
          <th class="px-4 py-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @foreach($cards as $card)
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-2 text-gray-700">{{ $card->id }}</td>
          <td class="px-4 py-2">
            <img src="{{ $card->icon }}" alt="cardImage" class="w-12 h-12 rounded object-contain border">
          </td>
          <td class="px-4 py-2 text-gray-900 font-medium">{{ $card->title }}</td>
          <td class="px-4 py-2 text-gray-700 truncate max-w-xs whitespace-nowrap overflow-hidden">
            {{ $card->description }}
          </td>
          <td class="px-4 py-2">
            <img src="{{ $card->image }}" alt="cardImage" class="w-12 h-12 rounded object-contain border">
          </td>
          <td class="px-4 py-2 text-gray-500">{{ \Carbon\Carbon::parse($card->created_at)->format('d M Y') }}</td>
          <td class="px-4 py-2 text-gray-500">{{ \Carbon\Carbon::parse($card->updated_at)->format('d M Y') }}</td>
          <td class="px-4 py-2 text-right space-x-2">
            <a href="{{ route('service.edit-service-card', $card->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white text-xs font-semibold rounded hover:bg-yellow-500">Edit</a>
            <form action="{{ route('delete.serviceCard.data', $card->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
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



@endsection
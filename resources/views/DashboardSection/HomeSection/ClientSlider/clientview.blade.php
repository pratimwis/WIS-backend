@extends('dashboard')

@section('content')
<div class="max-w-6xl mx-auto mt-10 space-y-12">


  {{-- Section 2: Slider Images Table --}}
  <section class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-bold text-gray-800">Client Slider Images</h2>
      <a href="{{ route('client-section.new') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
        + Upload New Image
      </a>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Image</th>
            <th class="px-4 py-3">Alt Text (Path)</th>
            <th class="px-4 py-3">Created</th>
            <th class="px-4 py-3">Updated</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach($sliders as $image)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 text-gray-700">{{ $image->id }}</td>
            <td class="px-4 py-3">
              <img src="{{ $image->image_path }}" alt="Slider Image {{ $image->id }}" class="w-20 h-auto rounded border shadow-sm">
            </td>
            <td class="px-4 py-3 text-gray-700 break-words max-w-xs">{{ $image->image_path }}</td>
            <td class="px-4 py-3 text-gray-500">{{ \Carbon\Carbon::parse($image->created_at)->format('d M Y') }}</td>
            <td class="px-4 py-3 text-gray-500">{{ \Carbon\Carbon::parse($image->updated_at)->format('d M Y') }}</td>

            <td class="px-4 py-3 text-right space-x-2">
              <a href="{{ route('client-section.edit', $image->id) }}"
                class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-xs font-semibold rounded hover:bg-yellow-600">
                Edit
              </a>
              <form action="{{ route('clientSlider.destroy', $image->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this image?');">
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
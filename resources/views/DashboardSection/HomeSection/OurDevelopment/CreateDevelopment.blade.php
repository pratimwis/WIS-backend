@extends('dashboard')

@section('content')
<div class="container mx-auto p-6">
  <h2 class="text-2xl font-bold mb-4">Our Development Sections</h2>

  <div class="overflow-x-auto ">
    <div class="flex justify-end mb-3">
      <a href="{{ route('CreateOurDevelopmentView.get') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
        Create New Development Section
      </a>
    </div>
    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
      <thead>
        <tr class="bg-gray-100 border-b">
          <th class="px-4 py-2 text-left">ID</th>
          <th class="px-4 py-2 text-left">Section ID</th>
          <th class="px-4 py-2 text-left">Title</th>
          <th class="px-4 py-2 text-left">Background Color</th>
          <th class="px-4 py-2 text-left">Content</th>
          <th class="px-4 py-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($ourDevelopmentData as $data)
        <tr class="border-b hover:bg-gray-50">
          <td class="px-4 py-2">{{ $data->id }}</td>
          <td class="px-4 py-2">{{ $data->section_id }}</td>
          <td class="px-4 py-2">{{ $data->title }}</td>
          <td class="px-4 py-2">
            <span class="px-2 py-1 rounded" style="background-color: #{{ ltrim($data->bg_color, '#') }};">
              {{ $data->bg_color }}
            </span>


          </td>
          <td class="px-4 py-2 truncate max-w-xs">{{ Str::limit($data->content, 100, '...') }}</td>
          <td class="px-4 py-2">
            <a href="{{ route('ourdevelopment.edit', $data->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>

            <form action="{{ route('ourdevelopment.delete', $data->id) }}" method="POST" class="inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
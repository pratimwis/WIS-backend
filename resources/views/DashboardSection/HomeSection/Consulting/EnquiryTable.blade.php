@extends('dashboard')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
  <h2 class="text-2xl font-semibold">Consultation Records</h2>

  @if($consultations->isEmpty())
  <p class="text-gray-600 mt-4">No consultation records found.</p>
  @else
  <div class="mt-6 overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
      <thead class="bg-gray-200">
        <tr>
          <th class="py-2 px-4 border-b">#</th>
          <th class="py-2 px-4 border-b">Full Name</th>
          <th class="py-2 px-4 border-b">Email</th>
          <th class="py-2 px-4 border-b">Phone</th>
          <th class="py-2 px-4 border-b">Help Topic</th>
          <th class="py-2 px-4 border-b">Message</th>
          <th class="py-2 px-4 border-b">Created At</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($consultations as $index => $consultation)
        <tr class="border-t">
          <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
          <td class="py-2 px-4 border-b">{{ $consultation->fullName }}</td>
          <td class="py-2 px-4 border-b">{{ $consultation->email }}</td>
          <td class="py-2 px-4 border-b">{{ $consultation->phone }}</td>
          <td class="py-2 px-4 border-b">{{ $consultation->helpTopic }}</td>
          <td class="py-2 px-4 border-b">{{ $consultation->message }}</td>
          <td class="py-2 px-4 border-b">{{ $consultation->created_at->format('d M Y, h:i A') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>
@endsection
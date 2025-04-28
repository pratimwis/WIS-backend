@extends('dashboard')

@section('content')
<main class="container mx-auto p-6 bg-gray-100 min-h-screen">

  <!-- KPI Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-lg p-5 flex items-center">
      <div class="p-3 bg-indigo-100 rounded-full">
        <svg class="w-6 h-6 text-indigo-600"><!-- icon --></svg>
      </div>
      <div class="ml-4">
        <h4 class="text-gray-500">Total Projects</h4>
        <p class="text-2xl font-bold">128</p>
      </div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-5 flex items-center">
      <div class="p-3 bg-green-100 rounded-full">
        <svg class="w-6 h-6 text-green-600"><!-- icon --></svg>
      </div>
      <div class="ml-4">
        <h4 class="text-gray-500">Monthly Revenue</h4>
        <p class="text-2xl font-bold">$34,500</p>
      </div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-5 flex items-center">
      <div class="p-3 bg-blue-100 rounded-full">
        <svg class="w-6 h-6 text-blue-600"><!-- icon --></svg>
      </div>
      <div class="ml-4">
        <h4 class="text-gray-500">Pending Tasks</h4>
        <p class="text-2xl font-bold">23</p>
      </div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-5 flex items-center">
      <div class="p-3 bg-yellow-100 rounded-full">
        <svg class="w-6 h-6 text-yellow-600"><!-- icon --></svg>
      </div>
      <div class="ml-4">
        <h4 class="text-gray-500">New Users</h4>
        <p class="text-2xl font-bold">49</p>
      </div>
    </div>
  </div>

  <!-- Charts Section -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-6">
      <h5 class="text-lg font-semibold text-gray-700 mb-4">Project Activity</h5>
      <canvas id="projectAreaChart"></canvas>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6">
      <h5 class="text-lg font-semibold text-gray-700 mb-4">Team Distribution</h5>
      <canvas id="teamPieChart"></canvas>
    </div>
  </div>

  <!-- Recent Projects Table -->
  <div class="bg-white rounded-lg shadow-lg p-6 overflow-x-auto">
    <h5 class="text-lg font-semibold text-gray-700 mb-4">Recent Projects</h5>
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Project</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lead</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deadline</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr>
          <td class="px-6 py-4 whitespace-nowrap">API Revamp</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
              Complete
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">Alice Johnson</td>
          <td class="px-6 py-4 whitespace-nowrap">May 5, 2025</td>
        </tr>
        <tr>
          <td class="px-6 py-4 whitespace-nowrap">New Dashboard</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
              In Progress
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">Bob Smith</td>
          <td class="px-6 py-4 whitespace-nowrap">Jun 20, 2025</td>
        </tr>
        <!-- add more rows as needed -->
      </tbody>
    </table>
  </div>

</main>
@endsection

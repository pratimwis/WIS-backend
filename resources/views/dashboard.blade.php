<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Web Idea Solution Dashboard</title>
  <meta name="description" content="Professional admin dashboard for managing site content" />
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pb6Tfjd0KpeHaRKMXYoox3tcwMezBxY6jUgQ4/nBu8zuyKA+7+M6zQf4FpG3oQiGfB5GGwrMHZ4y1fFhOiYpKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="/path/to/favicon.ico" />
  <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  <aside class="w-72 bg-white text-black flex flex-col fixed h-full z-10 shadow-xl rounded-2xl">
    <!-- Logo -->
    <div class="p-6 border-b border-blue-700 flex flex-col items-center space-x-3 text-left" >
      <img src="{{ config('app.url') . '/storage//WIS-logo/wis_log.webp'  }}" alt="Wis Logo" class="h-8 w-auto">
      
      <h2 class="text-sm font-bold pl-16 ">Admin Panel</h2>
    </div>
    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-4">

  <!-- Menu -->
  <div class="mt-8 space-y-2">
    <!-- Dashboard -->
    <a href="/dashboard/view" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-100 transition
      {{ request()->is('dashboard/view') ? 'bg-gradient-to-tr from-pink-500 to-purple-500 text-white shadow-md' : 'hover:bg-gray-100' }}">
      <div class="text-xl text-purple-600">🏠</div>
      <span class="text-gray-700 font-medium">Dashboard</span>
    </a>
  
    <!-- Home -->
    <a href="/dashboard/home" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-100 transition  
    {{ request()->is('dashboard/home') ? 'bg-gradient-to-tr from-pink-500 to-purple-500 text-white shadow-md' : 'hover:bg-gray-100' }}">
      <div class="text-xl text-purple-600">👤</div>
      <span class="text-gray-700 font-medium">Home</span>
    </a>
  
    <!-- Service page -->
    <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-100 transition">
      <div class="text-xl text-purple-600">🧑‍💼</div>
      <span class="text-gray-700 font-medium">Services</span>
    </a>
  
    <!-- About Us -->
    <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-100 transition">
      <div class="text-xl text-purple-600">ℹ️</div>
      <span class="text-gray-700 font-medium">About Us</span>
    </a>
  
    <!-- Our Location -->
    <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-100 transition">
      <div class="text-xl text-purple-600">📍</div>
      <span class="text-gray-700 font-medium">Our Location</span>
    </a>
  </div>
   
    </nav>
    <!-- Footer -->
    <div class="p-4 text-center text-sm border-t border-blue-700 opacity-75">
      &copy; {{ date('Y') }} Web Idea Solution. All Rights Reserved.
    </div>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 ml-72 p-6">
    <!-- Header -->
    <header class="sticky top-0 bg-white shadow-sm rounded-lg p-4 mb-6 flex justify-between items-center z-10">
      <div class="flex items-center space-x-3">
        <img src="{{ config('app.url') . '/storage//WIS-logo/wis_log.webp'  }}" alt="Wis Logo" class="h-8 w-auto">
        <h1 class="text-2xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}</h1>
      </div>
      <div class="flex items-center space-x-4">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D47A1&color=fff&size=32" alt="User Avatar" class="rounded-full">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition">Logout</button>
        </form>
      </div>
    </header>

    <!-- Dynamic Section -->
    <section class="bg-white shadow-sm rounded-lg p-6 min-h-[60vh]">
      @yield('content')
    </section>
  </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Company Admin Dashboard</title>
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
  <aside class="w-64 bg-blue-900 text-white flex flex-col fixed h-full z-10 shadow-lg">
    <!-- Logo -->
    <div class="p-6 border-b border-blue-700 flex flex-col items-center space-x-3">
      <img src="{{ asset('storage/WIS-logo/wis_log.webp') }}" alt="Company Logo" class="h-8 w-auto">
      <h2 class="text-sm font-bold pl-16">Admin Panel</h2>
    </div>
    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-4">
      <h3 class="text-blue-300 uppercase tracking-wider text-md font-semibold items-center">Home</h3>
      <ul class="space-y-2">
        <li>
          <a href="/home/banner/create-banner-section" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-image w-5"></i>
            <span class="ml-3">Banner Section</span>
          </a>
        </li>
        <li>
          <a href="/home/banner/carouselitems" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-photo-film w-5"></i>
            <span class="ml-3">Carousel Items</span>
          </a>
        </li>
        <li>
          <a href="/home/whoweare/create" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-users w-5"></i>
            <span class="ml-3">Who We Are</span>
          </a>
        </li>
        <li>
          <a href="/home/expertise/create-expertise" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-lightbulb w-5"></i>
            <span class="ml-3">Our Expertise</span>
          </a>
        </li>
        <li>
          <a href="/home/services" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-briefcase w-5"></i>
            <span class="ml-3">Our Services</span>
          </a>
        </li>
        <li>
          <a href="/home/appointment" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-calendar-check w-5"></i>
            <span class="ml-3">Book Appointment</span>
          </a>
        </li>
        <li>
          <a href="/home/industries/create" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-industry w-5"></i>
            <span class="ml-3">Our Industries</span>
          </a>
        </li>
        <li>
          <a href="/home/we-work-with/create" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-handshake-alt w-5"></i>
            <span class="ml-3">We Work With</span>
          </a>
        </li>
        <li>
          <a href="/home/client-slider/view" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-handshake-alt w-5"></i>
            <span class="ml-3">Client slider</span>
          </a>
        </li>
        <li>
          <a href="/home/consultation/consultant-data" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-user-tie w-5"></i>
            <span class="ml-3">Consultant Data</span>
          </a>
        </li>
        <li>
          <a href="/home/consultation/enquiry-table" class="flex items-center p-2 rounded hover:bg-blue-800 transition">
            <i class="fa-solid fa-table w-5"></i>
            <span class="ml-3">Enquiry Table</span>
          </a>
        </li>
      </ul>

      <h3 class="text-blue-300 uppercase tracking-wider text-xs font-semibold mt-6">Services</h3>
      <ul class="space-y-2">

      </ul>
    </nav>
    <!-- Footer -->
    <div class="p-4 text-center text-sm border-t border-blue-700 opacity-75">
      &copy; {{ date('Y') }} Company Name. All Rights Reserved.
    </div>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 ml-64 p-6">
    <!-- Header -->
    <header class="sticky top-0 bg-white shadow-sm rounded-lg p-4 mb-6 flex justify-between items-center z-10">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('storage/WIS-logo/wis_log.webp') }}" alt="Company Logo" class="h-8 w-auto">
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
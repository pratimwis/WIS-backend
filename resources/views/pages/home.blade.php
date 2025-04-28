@extends('dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="text-center">
        <h1 class="text-4xl font-extrabold text-gray-800">Home Section Management</h1>
        <p class="mt-4 text-lg text-gray-500">Manage and update your website's homepage sections with ease.</p>
    </div>

    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        
        <!-- Banner Section -->
        <a href="/dashboard/home/banner/create-banner-section" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Banner Section</h2>
            <p class="text-sm text-gray-500 opacity-90">Edit your homepage banner area.</p>
        </a>

        <!-- Who We Are -->
        <a href="/dashboard/home/whoweare/create" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Who We Are</h2>
            <p class="text-sm text-gray-500 opacity-90">Update the "About Us" section content.</p>
        </a>

        <!-- Our Expertise -->
        <a href="/dashboard/home/expertise/create-expertise" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Our Expertise</h2>
            <p class="text-sm text-gray-500 opacity-90">Manage the expertise showcase area.</p>
        </a>

        <!-- Our Services -->
        <a href="/dashboard/home/services" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Our Services</h2>
            <p class="text-sm text-gray-500 opacity-90">Manage your services showcase area.</p>
        </a>

        <!-- Book Appointment -->
        <a href="/dashboard/home/appointment" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Book Appointment</h2>
            <p class="text-sm text-gray-500 opacity-90">Manage the appointment booking section.</p>
        </a>

        <!-- Our Industries -->
        <a href="/dashboard/home/industries/create" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Our Industries</h2>
            <p class="text-sm text-gray-500 opacity-90">Manage the industries showcase area.</p>
        </a>

        <!-- We Work With -->
        <a href="/dashboard/home/we-work-with/create" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">We Work With</h2>
            <p class="text-sm text-gray-500 opacity-90">Manage the "We Work With" partners section.</p>
        </a>

        <!-- Client Slider -->
        <a href="/dashboard/home/client-slider/view" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Client Slider</h2>
            <p class="text-sm text-gray-500 opacity-90">Manage the client logos slider area.</p>
        </a>

        <!-- Consultation Data -->
        <a href="/dashboard/home/consultation/consultant-data" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Consultation Data</h2>
            <p class="text-sm text-gray-500 opacity-90">Manage consultation inquiries and records.</p>
        </a>

        <!-- Enquiry Data -->
        <a href="/dashboard/home/consultation/enquiry-table" class="block bg-white p-6 rounded-2xl text-center shadow-md border-2 border-transparent hover:border-gradient hover:from-pink-500 hover:to-purple-500 hover:shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Enquiry Data</h2>
            <p class="text-sm text-gray-500 opacity-90">View and manage enquiry submissions.</p>
        </a>

    </div>
</div>
@endsection

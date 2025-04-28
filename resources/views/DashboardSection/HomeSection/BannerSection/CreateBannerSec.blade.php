@extends('dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">Manage Banner Section</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Banner Form --}}
    <div class="bg-white shadow-md rounded-lg p-8 mb-10">
        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">
                    Title <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                    id="title" 
                    name="title" 
                    class="w-full p-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror" 
                    value="{{ old('title', $bannerSecData->title ?? '') }}" 
                    required>
                @error('title')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Blinking Text --}}
            <div class="mb-6">
                <label for="blinkingText" class="block text-gray-700 font-semibold mb-2">
                    Blinking Text <span class="text-red-500">*</span> 
                    <span class="text-sm text-gray-500">(Separate with commas)</span>
                </label>
                <input type="text" 
                    id="blinkingText" 
                    name="blinkingText" 
                    class="w-full p-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 @error('blinkingText') border-red-500 @enderror" 
                    value="{{ old('blinkingText', is_array($bannerSecData->blinkingText ?? null) ? implode(', ', $bannerSecData->blinkingText) : '') }}" 
                    placeholder="e.g. Leading Web Development, Digital Solutions in Kolkata" 
                    required>
                @error('blinkingText')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-semibold mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full p-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                    required>{{ old('description', $bannerSecData->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Button Text --}}
            <div class="mb-6">
                <label for="buttonText" class="block text-gray-700 font-semibold mb-2">
                    Button Text <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                    id="buttonText" 
                    name="buttonText" 
                    class="w-full p-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 @error('buttonText') border-red-500 @enderror" 
                    value="{{ old('buttonText', $bannerSecData->buttonText ?? '') }}" 
                    required>
                @error('buttonText')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Background Image --}}
            <div class="mb-6">
                <label for="backgroundImage" class="block text-gray-700 font-semibold mb-2">
                    Background Image <span class="text-red-500">*</span> 
                    <span class="text-sm text-gray-500">(jpeg, png, jpg, gif | Max: 2MB)</span>
                </label>
                <input type="file" 
                    id="backgroundImage" 
                    name="backgroundImage" 
                    accept="image/*" 
                    class="w-full p-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 @error('backgroundImage') border-red-500 @enderror">
                @error('backgroundImage')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

                @if (!empty($bannerSecData->backgroundImage))
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Current Image:</p>
                        <img src="{{ config('app.url') . '/storage/' . ltrim($bannerSecData->backgroundImage, '/') }}" 
                            alt="Current banner background" 
                            class="w-40 h-24 object-cover mt-2 rounded-lg border ">
                    </div>
                @endif
            </div>

            {{-- Image Alt Text --}}
            <div class="mb-6">
                <label for="imageAlt" class="block text-gray-700 font-semibold mb-2">
                    Image Alt Text <span class="text-red-500">*</span>
                    <span class="text-sm text-gray-500">(For SEO and accessibility)</span>
                </label>
                <input type="text" 
                    id="imageAlt" 
                    name="imageAlt" 
                    placeholder="Descriptive text for the background image"
                    class="w-full p-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 @error('imageAlt') border-red-500 @enderror" 
                    value="{{ old('imageAlt', $bannerSecData->imageAlt ?? '') }}" 
                    required>
                @error('imageAlt')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                    {{ $bannerSecData ? 'Update Banner' : 'Create Banner' }}
                </button>
            </div>
        </form>
    </div>

    {{-- Carousel Section --}}
    <div class="bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Add Carousel Items</h2>
        <form action="{{ route('carousel.post') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">
                    Add Items <span class="text-sm text-gray-500">(Separate with commas)</span>
                </label>
                <input type="text" 
                    id="title" 
                    name="title" 
                    placeholder="Develop, Promote, Design, Innovate, Strategize"
                    class="w-full p-3 border  rounded-lg focus:ring-2 focus:ring-blue-500" 
                    value="{{ $carouselItems->pluck('title')->implode(', ') }}" 
                    required>
            </div>
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg transition duration-300">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

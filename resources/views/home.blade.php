@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Featured Dresses</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!--product card-->
        <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden">
            <img src="https://via.placeholder.com/300x400" alt="Dress" class="w-full h-80 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-lg">Elegant Summer Dress</h3>
                <p class="text-pink-600 font-bold mt-2">$49.99</p>
                <button class="mt-3 w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700">Add to Cart</button>
            </div>
        </div>

        
        <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden">
            <img src="https://via.placeholder.com/300x400" alt="Dress" class="w-full h-80 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-lg">Casual Denim Jacket</h3>
                <p class="text-pink-600 font-bold mt-2">$39.99</p>
                <button class="mt-3 w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700">Add to Cart</button>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden">
            <img src="https://via.placeholder.com/300x400" alt="Dress" class="w-full h-80 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-lg">Floral Maxi Dress</h3>
                <p class="text-pink-600 font-bold mt-2">$59.99</p>
                <button class="mt-3 w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700">Add to Cart</button>
            </div>
        </div>
    </div>
        <a href="/" class="flex items-center space-x-2">
        <!-- Optional SVG Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 2l3 7h7l-5.5 4.5L18 21l-6-4-6 4 1.5-7.5L2 9h7l3-7z" />
        </svg>

        <!-- Brand Name -->
        <span class="text-2xl font-bold tracking-wide text-gray-800">
            <span class="text-pink-600">Etherna</span> Wear
        </span>
    </a>
@endsection
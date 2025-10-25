@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">

    {{-- 🔙 Back to Shop --}}
    <a href="{{ route('shop.index') }}" 
       class="inline-flex items-center text-[#4E342E] hover:text-[#3E2723] mb-6 font-medium transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
             class="w-5 h-5 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
        Back to Shop
    </a>

    <div class="flex flex-col md:flex-row gap-10 bg-white shadow-lg rounded-2xl p-6">
        
        <div class="flex-1">
            <div class="w-full aspect-square overflow-hidden rounded-xl">
                <img src="{{ asset('storage/' . $product->image) }}" 
                alt="{{ $product->name }}"
                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
            </div>
        </div>

        <div class="flex-1 flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                <p class="text-xl text-[#4E342E] font-semibold mb-4">
                    ₱{{ number_format($product->price, 2) }}
                </p>
                <p class="text-gray-700 mb-4 leading-relaxed">{{ $product->description }}</p>
                <p class="text-sm text-gray-500 mb-6">
                    <span class="font-semibold text-gray-700">Stock:</span> {{ $product->stock }}
                </p>
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                @csrf
                <div class="flex items-center space-x-4 mb-4">
                    <label for="quantity" class="text-sm font-medium text-gray-700">Quantity:</label>
                    <input type="number" 
                           id="quantity" 
                           name="quantity" 
                           value="1" 
                           min="1" 
                           max="{{ $product->stock }}"
                           class="w-20 border border-gray-300 rounded-lg px-2 py-1 text-center focus:ring-2 focus:ring-[#4E342E] focus:outline-none">
                </div>

                <button type="submit" 
                        class="w-full bg-[#4E342E] hover:bg-[#3E2723] text-white font-semibold py-3 rounded-lg transition shadow-md">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

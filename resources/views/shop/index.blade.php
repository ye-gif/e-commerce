@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-5 text-gray-800">All Products</h1>

    <!-- Category Filter -->
    <form method="GET" action="{{ route('shop.index') }}" class="mb-6">
        <select name="category_id" onchange="this.form.submit()" 
                class="w-40 md:w-40 border border-[#4E342E] bg-white text-sm md:text-base font-medium p-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-[#6D4C41] transition duration-150 ease-in-out">
            <option value=""> All Categories </option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Product Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
        @foreach($products as $product)
        <div class="group bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition transform hover:-translate-y-1 p-3 flex flex-col justify-between">
            
            <!-- Product Image -->
            <a href="{{ route('product.show', $product->id) }}" class="block">
                <img src="{{ asset('storage/' . $product->image) }}" 
                alt="{{ $product->name }}"
                     class="w-full h-48 object-cover rounded-lg group-hover:scale-105 transition duration-500">
            </a>

            <!-- Product Info -->
            <div class="mt-3 flex-1">
                <h2 class="text-base font-semibold text-gray-800 truncate">{{ $product->name }}</h2>
                <p class="text-[#4E342E] font-semibold text-sm mt-1">₱{{ number_format($product->price, 2) }}</p>
            </div>

            <!-- Buttons -->
            <div class="mt-3 flex flex-col space-y-2">
                <a href="{{ route('product.show', $product->id) }}" 
                   class="w-full text-center border border-[#4E342E] text-[#4E342E] hover:bg-[#4E342E] hover:text-white px-3 py-1.5 rounded-full text-xs font-medium transition">
                   View Details
                </a>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-[#4E342E] hover:bg-[#3E2723] text-white px-3 py-1.5 rounded-full text-xs font-medium transition shadow">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection

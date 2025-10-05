@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-pink-500 to-yellow-500 text-white p-8 rounded-2xl shadow-lg mb-8">
        <h1 class="text-3xl font-bold">Welcome back, {{ Auth::user()->name }} </h1>
        <p class="mt-2 text-lg">We’re glad to see you again! Ready to shop your favorites?</p>
        <a href="{{ route('shop.index') }}" 
           class="mt-4 inline-block bg-white text-pink-600 px-6 py-2 rounded-lg font-semibold shadow hover:bg-gray-100 transition">
           Start Shopping
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-4">Featured Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($products ?? [] as $product)
            <div class="bg-white shadow rounded-lg p-4 hover:shadow-lg transition">
                <img src="{{ $product->image_url ?? asset('images/placeholder.png') }}" alt="{{ $product->name }}" class="rounded-md mb-3">
                <h3 class="font-semibold">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm">₱{{ number_format($product->price, 2) }}</p>
                <a href="{{ route('product.show', $product->id) }}" class="mt-2 inline-block bg-pink-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-pink-600 transition">
                    View
                </a>
            </div>
        @empty
            <p class="col-span-full text-gray-500">No featured products yet.</p>
        @endforelse
    </div>


    <!-- Quick Actions -->
        <a href="{{ route('profile.edit') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h3 class="font-bold text-lg">My Profile</h3>
            <p class="text-gray-600 text-sm mt-2">Manage your account settings and details.</p>
        </a>
    </div>
</div>
@endsection
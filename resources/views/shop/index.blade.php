@extends('layouts.app')

@section('content')
<div class="text-center mb-8">
    <h1 class="text-3xl font-bold">Shop All Products</h1>
    <p class="text-gray-500">Browse our latest collection and start shopping.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($products as $product)
        <div class="bg-white rounded-lg shadow p-4">
            <img src="{{ $product->image_url ?? asset('images/placeholder.png') }}" class="w-full h-48 object-cover rounded" alt="{{ $product->name }}">
            <h3 class="mt-3 font-semibold">{{ $product->name }}</h3>
            <p class="text-pink-600 font-bold">₱{{ number_format($product->price, 2) }}</p>
            <a href="{{ route('product.show', $product->id ?? 0) }}" class="inline-block mt-2 bg-pink-500 text-white px-3 py-1 rounded">View</a>
        </div>
    @empty
        <p class="col-span-full text-gray-500">No products yet.</p>
    @endforelse
</div>

@if(method_exists($products, 'links'))
    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endif
@endsection

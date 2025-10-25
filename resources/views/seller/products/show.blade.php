@extends('layouts.seller')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-[#4E2C1A] mb-6">View Product Details</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Product Image --}}
        <div class="flex justify-center items-center">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            @else
                <p class="text-gray-500 italic">No image available</p>
            @endif
        </div>

        {{-- Product Info --}}
        <div>
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 w-1/3 font-semibold text-[#4E2C1A]">Product ID</th>
                    <td class="p-3">{{ $product->id }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Name</th>
                    <td class="p-3">{{ $product->name }}</td>
                </tr>
                <tr class="border-b align-top">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Description</th>
                    <td class="p-3">{!! $product->description !!}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Price</th>
                    <td class="p-3">₱{{ number_format($product->price, 2) }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Stock</th>
                    <td class="p-3">{{ $product->stock }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Category</th>
                    <td class="p-3">{{ $product->category->name ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('seller.products.index') }}" 
           class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
           ← Back to Products
        </a>

        <a href="{{ route('seller.products.edit', $product->id) }}" 
           class="bg-[#4E2C1A] text-white px-6 py-2 rounded-lg hover:bg-[#6A3B22] transition">
           Edit Product
        </a>
    </div>
</div>
@endsection

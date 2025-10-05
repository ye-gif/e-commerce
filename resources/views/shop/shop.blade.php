@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white shadow rounded-lg p-6">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-80 object-cover rounded">
        <h1 class="mt-4 text-2xl font-bold">{{ $product->name }}</h1>
        <p class="mt-2 text-pink-600 text-lg font-semibold">₱{{ number_format($product->price, 2) }}</p>
        <p class="mt-4 text-gray-600">{{ $product->description ?? 'No description available.' }}</p>
    </div>
</div>
@endsection

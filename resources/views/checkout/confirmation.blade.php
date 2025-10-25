@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 text-center">
    <h1 class="text-3xl font-bold text-text1 mb-4">Thank you for your order!</h1>
    <p class="text-lg text-gray-700 mb-6">
        Your order <strong>#{{ $order->id }}</strong> has been placed successfully.
    </p>

    <div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
        <h2 class="text-xl font-semibold mb-3">Order Summary</h2>
        <p><strong>Name:</strong> {{ $order->full_name }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Address:</strong> {{ $order->address }}</p>
        <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
        <p class="mt-3 font-bold text-lg">Total: ₱{{ number_format($order->total, 2) }}</p>
    </div>

    <a href="{{ route('shop.index') }}" 
       class="mt-4 inline-block bg-[#4E342E] hover:bg-[#3E2723] text-white px-6 py-2 rounded-full text-sm font-medium transition shadow-md">
       Continue Shopping
    </a>
</div>
@endsection

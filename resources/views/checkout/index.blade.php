@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    {{--  Back to cart --}}
    <a href="{{ route('cart.index') }}" 
       class="inline-flex items-center text-[#4E342E] hover:text-[#3E2723] mb-6 font-medium transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
             class="w-5 h-5 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
        Back to Cart
    </a>

    {{-- Checkout Summary --}}
    <h1 class="text-2xl font-bold mb-6">Checkout Summary</h1>

    @if (empty($items))
        <p class="text-gray-500">No items selected for checkout.</p>
        <a href="{{ route('cart.index') }}" class="bg-text1 text-white px-6 py-3 rounded">Go Back</a>
    @else
        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-8">
            @csrf

            @foreach($items as $id => $item)
                <input type="hidden" name="selected_items[]" value="{{ $id }}">
            @endforeach

            @foreach(session('selected_items', []) as $id)
                <input type="hidden" name="selected_items[]" value="{{ $id }}">
            @endforeach

            {{-- Product Summary Table --}}
            <div class="bg-white shadow rounded-lg p-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Product</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Price</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Quantity</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $id => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . ($item['image'] ?? 'default.jpg')) }}" 
                                    alt="{{ $item['name'] ?? 'Product Image' }}" 
                                    class="w-16 h-16 object-cover rounded-lg shadow-sm">

                                    <div>
                                        <p class="font-semibold">{{ $item['name'] ?? 'Unknown Product' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">₱{{ number_format($item['price'], 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ $item['quantity'] }}</td>
                                <td class="px-6 py-4 text-center font-semibold">
                                    ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right mt-6 font-bold text-lg">
                    Total: ₱{{ number_format(collect($items)->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}
                </div>
            </div>

            {{-- Shipping Address Section --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Shipping Address</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Full Name</label>
                        <input type="text" name="full_name" class="w-full border rounded p-2 focus:ring-2 focus:ring-[#D4A373]" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Phone Number</label>
                        <input type="text" name="phone" class="w-full border rounded p-2 focus:ring-2 focus:ring-[#D4A373]" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-1">Address</label>
                        <textarea name="address" rows="3" class="w-full border rounded p-2 focus:ring-2 focus:ring-[#D4A373]" required></textarea>
                    </div>
                </div>
            </div>

            {{-- Payment Method Section --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Payment Method</h2>
                <div class="space-y-3">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="payment_method" value="Cash on Delivery" required>
                        <span>Cash on Delivery (COD)</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="payment_method" value="GCash" required>
                        <span>GCash</span>
                    </label>
                </div>
            </div>

            {{-- Place Order Button --}}
            <div class="flex justify-between items-center mt-8">
                <button type="submit" 
                        class="bg-button1 text-white px-6 py-3 rounded hover:bg-hover1 transition">
                    Place Order
                </button>
            </div>
        </form>
    @endif
</div>
@endsection

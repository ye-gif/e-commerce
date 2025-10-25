@extends('layouts.seller')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-[#4E2C1A] mb-6">Order Details</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Customer & Order Info --}}
        <div>
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 w-1/3 font-semibold text-[#4E2C1A]">Order ID</th>
                    <td class="p-3">{{ $order->id }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Customer</th>
                    <td class="p-3">{{ $order->full_name }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Phone</th>
                    <td class="p-3">{{ $order->phone }}</td>
                </tr>
                <tr class="border-b align-top">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Address</th>
                    <td class="p-3">{{ $order->address }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Payment Method</th>
                    <td class="p-3">{{ $order->payment_method }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Status</th>
                    <td class="p-3">
                        <span class="px-3 py-1 text-sm rounded-full 
                            {{ $order->status === 'Confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th class="text-left p-3 bg-gray-100 font-semibold text-[#4E2C1A]">Order Date</th>
                    <td class="p-3">{{ $order->created_at->format('M d, Y') }}</td>
                </tr>
            </table>
        </div>

        {{-- Ordered Products --}}
        <div>
            <h3 class="text-xl font-semibold text-[#4E2C1A] mb-3">Ordered Products</h3>
            
            @foreach ($order->orderItems as $item)
                <div class="flex items-center gap-3 mb-3 border-b pb-3">
                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                         alt="{{ $item->product->name }}" 
                         class="w-16 h-16 rounded-md object-cover border">

                    <div>
                        <p class="font-semibold text-[#4E2C1A]">{{ $item->product->name }}</p>
                        <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                        <p class="text-sm text-gray-600">₱{{ number_format($item->price, 2) }} each</p>
                    </div>
                </div>
            @endforeach

            <div class="mt-4 text-right border-t pt-3">
                <span class="font-bold text-lg text-[#4E2C1A]">
                    Total: ₱{{ number_format($order->total_price, 2) }}
                </span>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('seller.orders.index') }}" 
           class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
           ← Back to Orders
        </a>

    </div>
</div>
@endsection

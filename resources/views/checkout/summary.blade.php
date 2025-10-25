@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    {{-- Back to Shop --}}
    <a href="{{ route('shop.index') }}" 
       class="inline-flex items-center text-[#4E342E] hover:text-[#3E2723] mb-6 font-medium transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
             class="w-5 h-5 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
        Back to Shop
    </a>
    <h1 class="text-2xl font-bold mb-6">Order Summary</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6 space-y-6">
        <div>
            <h2 class="text-lg font-semibold mb-2">Order Details</h2>
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Customer Name:</strong> {{ $order->full_name }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Payment Method:</strong> 
                {{ ucfirst($order->notes) === 'Gcash' ? 'GCash / E-Wallet' : 'Cash on Delivery (COD)' }}
            </p>
            <p><strong>Status:</strong> 
                <span class="text-blue-600 font-semibold">{{ ucfirst($order->status) }}</span>
            </p>
        </div>

        @if(strtolower($order->notes) === 'gcash')
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mt-4">
                <h3 class="font-semibold mb-2 text-[#4E342E]">GCash / E-Wallet Payment</h3>
                <p><strong>GCash Number:</strong> 0917-123-4567</p>
                <p><strong>Account Name:</strong> Yolette Wellness & Beauty Center</p>
                <p class="mt-2 text-sm text-gray-600">
                    Please send your payment and upload your proof of transaction via your account page.
                </p>
            </div>
        @endif

        <div>
            <h2 class="text-lg font-semibold mb-2">Items Ordered</h2>
            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Product</th>
                        <th class="px-4 py-2 text-center">Price</th>
                        <th class="px-4 py-2 text-center">Quantity</th>
                        <th class="px-4 py-2 text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2">{{ $item->product_name }}</td>
                            <td class="px-4 py-2 text-center">₱{{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->quantity }}</td>
                            <td class="px-4 py-2 text-center">₱{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right mt-6 font-bold text-lg">
                Total: ₱{{ number_format($order->total_price, 2) }}
            </div>
        </div>
    </div>
</div>
@endsection

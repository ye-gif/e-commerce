@extends('layouts.app')

@section('content')
<div class="bg-[#F9F6F1] min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-6">
        <!--back button for dashboard-->
        <a href="{{ route('dashboard') }}" 
        class="inline-flex items-center gap-2 text-[#4E342E] hover:text-[#D4A373] font-medium mb-6 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Dashboard
        </a>


        <h1 class="text-3xl font-bold text-[#3E2723] mb-8 border-b-2 border-[#D4A373] pb-2">
            My Orders
        </h1>

        <!-- Orders List -->
        <div class="space-y-6">
            @forelse($orders ?? [] as $order)
                <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-[#3E2723]">Order #{{ $order->id }}</h2>
                        <p class="text-sm text-gray-600 mt-1">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                        <p class="text-sm mt-2">
                            <span class="font-medium text-[#8B6B4F]">Total:</span>
                            ₱{{ number_format($order->total, 2) }}
                        </p>
                    </div>

                    <div class="mt-4 md:mt-0">
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold 
                            @if($order->status === 'Delivered') bg-green-100 text-green-700
                            @elseif($order->status === 'Pending') bg-yellow-100 text-yellow-700
                            @elseif($order->status === 'Cancelled') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 text-gray-500">
                    <i class="fa-solid fa-box-open text-4xl mb-4 text-[#8B6B4F]"></i>
                    <p>You don’t have any orders yet.</p>
                    <a href="{{ route('shop.index') }}" 
                       class="mt-6 inline-block bg-[#4E342E] hover:bg-[#3E2723] text-white px-6 py-2 rounded-full font-medium transition">
                        Browse Products
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

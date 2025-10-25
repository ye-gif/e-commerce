@extends('layouts.seller')

@section('content')
<div class="p-6">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Orders</h1>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
        <div id="success-alert" class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    {{-- Orders Table Card --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <div class="bg-[#4B0E0E] px-6 py-3">
            <h2 class="text-lg font-semibold text-white">Order List</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border-t border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left">Order ID</th>
                        <th class="py-3 px-4 text-left">Customer</th>
                        <th class="py-3 px-4 text-left">Products</th>
                        <th class="py-3 px-4 text-left">Total</th>
                        <th class="py-3 px-4 text-left">Payment Method</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-center">Date</th>
                        <th class="py-3 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $order->id }}</td>
                            <td class="py-3 px-4">{{ $order->user->name ?? 'Unknown' }}</td>

                            {{-- Products --}}
                            <td class="py-3 px-4">
                                <ul class="list-disc ml-5">
                                    @foreach ($order->orderItems as $item)
                                        <div class="flex items-center gap-2 mb-1">
                                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                alt="{{ $item->product->name }}" 
                                                class="w-10 h-10 rounded-md object-cover border">
                                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                                        </div>
                                    @endforeach
                                </ul>
                            </td>

                            <td class="py-3 px-4 font-semibold">₱{{ number_format($order->total_price, 2) }}</td>
                            <td class="py-3 px-4">{{ ucfirst($order->payment_method ?? 'N/A') }}</td>

                            <td class="py-3 px-4">
                                <span class="px-3 py-1 rounded-full text-sm
                                    @if($order->status == 'completed') bg-green-100 text-green-700
                                    @elseif($order->status == 'processing') bg-yellow-100 text-yellow-700
                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="py-3 px-4 text-center">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('seller.orders.show', $order->id) }}"
                                   class="bg-[#4B0E0E] hover:bg-[#6A1B1B] text-white px-3 py-1 rounded-md text-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 text-center text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection

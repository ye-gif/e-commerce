@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4">

    @if(session('error'))
        <div class="fixed top-5 right-5 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif

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

    @if($orders->isEmpty())
        <div class="bg-white p-8 shadow-lg rounded-lg text-center">
            <p class="text-gray-500 mb-6 text-lg">You have no orders yet.</p>
            <a href="{{ route('shop.index') }}" 
               class="inline-block bg-gradient-to-r from-[#D4A373] to-[#A56B46] text-white px-8 py-3 rounded-lg hover:opacity-90 transition">
                Start Shopping
            </a>
        </div>
    @else
        @foreach($orders as $order)
            <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100 hover:shadow-xl transition">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b pb-4">
                    <div>
                        <h3 class="font-semibold text-xl text-gray-800">Order #{{ $order->id }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Placed on {{ $order->created_at->format('M d, Y h:i A') }}
                        </p>
                    </div>

                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-400',
                            'completed' => 'bg-green-600',
                            'cancelled' => 'bg-red-500',
                        ];
                    @endphp

                    <span class="mt-3 md:mt-0 px-4 py-1 rounded-full text-white font-medium text-sm {{ $statusColors[$order->status] ?? 'bg-gray-400' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                {{-- Cancel Button (for pending orders only) --}}
                @if($order->status === 'pending')
                    <button type="button" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition mb-4"
                        onclick="openCancelModal({{ $order->id }})">
                        Cancel Order
                    </button>
                @endif

                {{-- 🛒 Order Items --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50">
                            <tr class="text-gray-600 text-sm uppercase">
                                <th class="py-3 px-4">Product</th>
                                <th class="py-3 px-4 text-center">Price</th>
                                <th class="py-3 px-4 text-center">Quantity</th>
                                <th class="py-3 px-4 text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr class="border-t hover:bg-gray-50 transition">
                                    <td class="py-4 px-4 flex items-center space-x-4">
                                        <span class="text-gray-800 font-medium">{{ $item->product->name ?? 'Unknown Product' }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-center text-gray-700">₱{{ number_format($item->price, 2) }}</td>
                                    <td class="py-4 px-4 text-center text-gray-700">{{ $item->quantity }}</td>
                                    <td class="py-4 px-4 text-center font-semibold text-gray-800">₱{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Order Summary --}}
                <div class="mt-6 flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="text-gray-600 text-sm space-y-1">
                        <p><strong>Shipping to:</strong> {{ $order->full_name }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                    </div>
                    <div class="mt-4 md:mt-0 text-right font-bold text-lg text-gray-800">
                        Total: ₱{{ number_format($order->total_price, 2) }}
                    </div>
                </div>

                {{-- Cancel Button (Added Section) --}}
                @if($order->status !== 'cancelled' && $order->status !== 'completed')
                    <div class="mt-4 text-right">
                        <button type="button"
                            onclick="openCancelModal({{ $order->id }})"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium text-sm transition">
                            Cancel Order
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>

{{--  Cancel Order Modal --}}
<div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition">
    <div class="bg-white rounded-xl p-6 max-w-sm w-full text-center shadow-2xl transform scale-95 animate-popUp">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Cancel Order?</h2>
        <p class="text-gray-600 mb-6">Are you sure you want to cancel this order? This action cannot be undone.</p>
        <form id="cancelForm" method="POST">
            @csrf
            @method('PATCH')
            <div class="flex justify-center space-x-3">
                <button type="button" onclick="closeCancelModal()" 
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium">
                    No, Keep Order
                </button>
                <button type="submit" 
                    class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white font-medium">
                    Yes, Cancel
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal JS --}}
<script>
function openCancelModal(orderId) {
    const modal = document.getElementById('cancelModal');
    const form = document.getElementById('cancelForm');
    form.action = `/orders/${orderId}/cancel`;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeCancelModal() {
    const modal = document.getElementById('cancelModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}
</script>

{{-- Simple Pop Animation --}}
<style>
@keyframes popUp {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>

<script>
function refreshOrders() {
    $.get("{{ route('customer.orders.data') }}", function(data) {
        $('.max-w-7xl').html(data);
    });
}
setInterval(refreshOrders, 10000);
</script>
@endsection

<div class="border rounded-lg p-4 mb-4 shadow-sm bg-white">
    <div class="flex justify-between items-center mb-3">
        <h3 class="font-semibold text-brown-dark">Order #{{ $order->id }}</h3>
        <span class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</span>
    </div>

    <ul class="mb-3 text-gray-700 text-sm">
        @foreach($order->items as $item)
            <li class="flex justify-between py-1 border-b border-gray-100">
                <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                <span>₱{{ number_format($item->price * $item->quantity, 2) }}</span>
            </li>
        @endforeach
    </ul>

    <div class="flex justify-between items-center">
        <p class="font-semibold text-brown-dark">
            Total: ₱{{ number_format($order->total, 2) }}
        </p>

        @if($order->status === 'to_receive')
            <a href="{{ route('orders.confirm', $order->id) }}" 
               class="bg-gold text-brown-dark px-3 py-1 rounded hover:bg-yellow-400 transition">
               Mark as Received
            </a>
        @elseif($order->status === 'to_ship')
            <span class="text-gray-600 text-sm">Preparing for shipment</span>
        @elseif($order->status === 'refund')
            <span class="text-red-600 text-sm font-medium">Refund Processing</span>
        @elseif($order->status === 'complete')
            <span class="text-green-600 text-sm font-medium">Delivered</span>
        @endif
    </div>
</div>

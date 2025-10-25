@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-brown-dark mb-8">My Orders</h1>

    <!-- Tabs -->
    <div x-data="{ tab: 'to-ship' }">
        <div class="flex space-x-4 mb-6 border-b pb-2">
            <button @click="tab = 'to-ship'"
                :class="tab === 'to-ship' ? 'text-gold border-b-2 border-gold' : 'text-gray-600'"
                class="px-4 py-2 font-semibold focus:outline-none">
                To Ship
            </button>
            <button @click="tab = 'to-receive'"
                :class="tab === 'to-receive' ? 'text-gold border-b-2 border-gold' : 'text-gray-600'"
                class="px-4 py-2 font-semibold focus:outline-none">
                To Receive
            </button>
            <button @click="tab = 'refund'"
                :class="tab === 'refund' ? 'text-gold border-b-2 border-gold' : 'text-gray-600'"
                class="px-4 py-2 font-semibold focus:outline-none">
                Refund
            </button>
            <button @click="tab = 'complete'"
                :class="tab === 'complete' ? 'text-gold border-b-2 border-gold' : 'text-gray-600'"
                class="px-4 py-2 font-semibold focus:outline-none">
                Completed
            </button>
        </div>

        <!-- To Ship -->
        <div x-show="tab === 'to-ship'">
            @forelse($orders->where('status', 'to_ship') as $order)
                @include('dashboard.partials.order-card', ['order' => $order])
            @empty
                <p class="text-gray-500 text-center py-6">No orders to ship.</p>
            @endforelse
        </div>

        <!-- To Receive -->
        <div x-show="tab === 'to-receive'">
            @forelse($orders->where('status', 'to_receive') as $order)
                @include('dashboard.partials.order-card', ['order' => $order])
            @empty
                <p class="text-gray-500 text-center py-6">No orders to receive.</p>
            @endforelse
        </div>

        <!-- Refund -->
        <div x-show="tab === 'refund'">
            @forelse($orders->where('status', 'refund') as $order)
                @include('dashboard.partials.order-card', ['order' => $order])
            @empty
                <p class="text-gray-500 text-center py-6">No refund requests.</p>
            @endforelse
        </div>

        <!-- Completed -->
        <div x-show="tab === 'complete'">
            @forelse($orders->where('status', 'complete') as $order)
                @include('dashboard.partials.order-card', ['order' => $order])
            @empty
                <p class="text-gray-500 text-center py-6">No completed orders.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

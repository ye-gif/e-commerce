@extends('layouts.seller')

@section('content')
<div class="space-y-10 p-6 bg-[#f9f6f2] min-h-screen">

    <!-- Seller Profile (Now on Top) -->
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-md p-8 border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div class="flex items-center space-x-4 sm:space-x-6">
                <div class="bg-[#f9f6f2] p-4 rounded-full shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-16 h-16 text-[#6B4226]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-[#4E2C1A]">{{ Auth::user()->name }}</h1>
                    <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        Seller since {{ Auth::user()->created_at->format('F d, Y') }}
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-200">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Account Info -->
            <div class="bg-[#f9f6f2] p-5 rounded-xl shadow-sm border border-[#e5d8cc]">
                <h2 class="text-lg font-semibold text-[#4E2C1A] mb-3">Account Information</h2>
                <ul class="space-y-2 text-gray-700">
                    <li><strong>Role:</strong> Seller</li>
                    <li><strong>Account ID:</strong> {{ Auth::user()->id }}</li>
                    <li><strong>Joined:</strong> {{ Auth::user()->created_at->diffForHumans() }}</li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="bg-[#f9f6f2] p-5 rounded-xl shadow-sm border border-[#e5d8cc]">
                <h2 class="text-lg font-semibold text-[#4E2C1A] mb-3">Contact Details</h2>
                <ul class="space-y-2 text-gray-700">
                    <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                    <li><strong>Phone:</strong> <span class="text-gray-400 italic">Not provided</span></li>
                    <li><strong>Address:</strong> <span class="text-gray-400 italic">Not provided</span></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Dashboard Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Products</h3>
            <p class="text-4xl font-bold text-[#6B4226]">{{ $productCount ?? 0 }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Orders</h3>
            <p class="text-4xl font-bold text-[#6B4226]">{{ $orderCount ?? 0 }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Revenue</h3>
            <p class="text-4xl font-bold text-[#6B4226]">
                ₱{{ number_format($revenue ?? 0, 2) }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Users</h3>
            <p class="text-4xl font-bold text-[#6B4226]">{{ $userCount ?? 0 }}</p>
        </div>
    </div>

    <!-- Recent Orders Section -->
    <div class="max-w-5xl mx-auto mt-10">
        <h2 class="text-xl font-semibold text-[#4E2C1A] mb-4">Recent Orders</h2>
        @if(!empty($recentOrders) && count($recentOrders) > 0)
            <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200">
                <table class="min-w-full text-gray-700">
                    <thead class="bg-[#D4A373] text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Order #</th>
                            <th class="py-3 px-4 text-left">Product</th>
                            <th class="py-3 px-4 text-left">Quantity</th>
                            <th class="py-3 px-4 text-left">Total</th>
                            <th class="py-3 px-4 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentOrders as $order)
                            <tr class="border-t hover:bg-[#f9f6f2] transition">
                                <td class="py-3 px-4">{{ $order->id }}</td>
                                <td class="py-3 px-4">{{ $order->product_name }}</td>
                                <td class="py-3 px-4">{{ $order->quantity }}</td>
                                <td class="py-3 px-4">₱{{ number_format($order->total, 2) }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-sm
                                        @if($order->status == 'Completed') bg-green-100 text-green-700 
                                        @elseif($order->status == 'Pending') bg-yellow-100 text-yellow-700
                                        @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 italic">No recent orders yet.</p>
        @endif
    </div>

</div>
@endsection

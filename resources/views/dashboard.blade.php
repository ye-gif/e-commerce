@extends('layouts.app')

@section('content')
<div class="bg-[#F9F6F1] min-h-screen flex flex-col">
    <div class="max-w-7xl mx-auto px-6 py-12 flex-grow">

        <!-- Welcome Banner -->
        <div class="relative bg-gradient-to-r from-[#4E342E] via-[#3E2723] to-[#1b1410] text-white p-12 rounded-3xl shadow-2xl overflow-hidden mb-14">
            <div class="absolute inset-0 bg-[url('{{ asset('images/hero-bg.jpg') }}')] bg-cover bg-center opacity-25 mix-blend-overlay"></div>
            <div class="relative z-10 max-w-3xl">
                <h1 class="text-5xl font-extrabold tracking-wide drop-shadow-md">
                    Welcome back, {{ Auth::user()->name }}
                </h1>
                <p class="mt-4 text-lg text-gray-200 leading-relaxed">
                    Experience timeless craftsmanship and sophistication. Step into your world of luxury.
                </p>
                <a href="{{ route('shop.index') }}" 
                   class="mt-8 inline-block bg-[#D4A373] hover:bg-[#c18b5f] text-[#1b1410] px-8 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    Start Shopping
                </a>
            </div>
        </div>

        <!-- Featured Products -->
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-[#3E2723]">Featured Products</h2>
                <a href="{{ route('shop.index') }}" class="text-[#8B6B4F] hover:text-[#4E342E] text-sm font-medium transition">
                    View All →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse($products ?? [] as $product)
                    <div class="group bg-white shadow-md rounded-2xl overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-1">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-60 object-cover group-hover:scale-105 transition duration-500">

                        </div>
                        <div class="p-5 text-center">
                            <h3 class="font-semibold text-lg text-[#2C261E] truncate">{{ $product->name }}</h3>
                            <p class="text-[#8B6B4F] text-sm mt-1">₱{{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('product.show', $product->id) }}" 
                               class="mt-4 inline-block bg-[#4E342E] hover:bg-[#3E2723] text-white px-6 py-2 rounded-full text-sm font-medium transition shadow-md">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-gray-500 text-center py-10">No featured products yet.</p>
                @endforelse
            </div>
        </section>

        <!-- Quick Actions -->
        <section class="mt-16 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <a href="{{ route('profile.edit') }}" 
               class="group bg-white p-10 rounded-3xl shadow-md hover:shadow-2xl transition transform hover:-translate-y-1 text-center">
                <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-[#F3EDE6] flex items-center justify-center group-hover:bg-[#D4A373]/20 transition">
                    <i class="fa-regular fa-user text-[#4E342E] text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-[#3E2723]">My Profile</h3>
                <p class="text-gray-600 text-sm mt-2">Manage your account settings and personal details.</p>
            </a>

            <a href="{{ route('shop.index') }}" 
               class="group bg-gradient-to-br from-[#4E342E] to-[#3E2723] p-10 rounded-3xl shadow-md hover:shadow-2xl transition transform hover:-translate-y-1 text-center text-white">
                <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-[#D4A373]/20 flex items-center justify-center group-hover:bg-[#D4A373]/40 transition">
                    <i class="fa-solid fa-bag-shopping text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold">Shop Collection</h3>
                <p class="text-gray-200 text-sm mt-2">Explore our exclusive lineup of luxury designer bags.</p>
            </a>

            <a href="{{ route('orders.index') }}" 
               class="group bg-white p-10 rounded-3xl shadow-md hover:shadow-2xl transition transform hover:-translate-y-1 text-center">
                <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-[#F3EDE6] flex items-center justify-center group-hover:bg-[#D4A373]/20 transition">
                    <i class="fa-solid fa-box-open text-[#4E342E] text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-[#3E2723]">My Orders</h3>
                <p class="text-gray-600 text-sm mt-2">Track your recent purchases and shipping updates.</p>
            </a>
        </section>

    </div>

    <!-- Page Content -->
        <main class="flex-1 p-8 bg-gray-50">
            @yield('content')
        </main>
</div>
@endsection

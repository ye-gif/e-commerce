@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="hero-carousel" class="relative w-full overflow-hidden">
        <!-- Slide 1 -->
        <div class="carousel-slide relative w-full h-[600px] bg-cover bg-center flex flex-col justify-center items-center text-white transition-opacity duration-1000 opacity-100"
            style="background-image: url('{{ asset('images/hero1-bg.jpg') }}');">
            <div class="bg-black/50 absolute inset-0"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-5xl font-extrabold mb-4">
                    Discover <span class="text-[#D4A373]">Luxury Bags</span>
                </h1>
                <p class="text-lg text-gray-200 mb-8">Elegant designs crafted for timeless style.</p>
                <a href="{{ route('shop.index') }}" class="bg-[#D4A373] hover:bg-[#c18b5f] text-[#1b1410] px-8 py-3 rounded-lg font-semibold shadow-lg transition">
                    Shop Now
                </a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-slide absolute top-0 left-0 w-full h-[600px] bg-cover bg-center flex flex-col justify-center items-center text-white transition-opacity duration-1000 opacity-0"
            style="background-image: url('{{ asset('images/hero2-bg.jpg') }}');">
            <div class="bg-black/50 absolute inset-0"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-5xl font-extrabold mb-4">
                    New Collection: <span class="text-[#D4A373]">Suede Elegance</span>
                </h1>
                <p class="text-lg text-gray-200 mb-8">Soft textures. Bold statements.</p>
                <a href="{{ route('shop.index') }}" class="bg-[#D4A373] hover:bg-[#c18b5f] text-[#1b1410] px-8 py-3 rounded-lg font-semibold shadow-lg transition">
                    Explore
                </a>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-slide absolute top-0 left-0 w-full h-[600px] bg-cover bg-center flex flex-col justify-center items-center text-white transition-opacity duration-1000 opacity-0"
            style="background-image: url('{{ asset('images/hero3-bg.jpg') }}');">
            <div class="bg-black/50 absolute inset-0"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-5xl font-extrabold mb-4">
                    Handcrafted <span class="text-[#D4A373]">Leather Artistry</span>
                </h1>
                <p class="text-lg text-gray-200 mb-8">Experience luxury in every stitch.</p>
                <a href="{{ route('shop.index') }}" class="bg-[#D4A373] hover:bg-[#c18b5f] text-[#1b1410] px-8 py-3 rounded-lg font-semibold shadow-lg transition">
                    View More
                </a>
            </div>
        </div>

        <!-- Navigation Dots -->
        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex space-x-3 z-20">
            <button class="carousel-dot w-3 h-3 bg-white/50 rounded-full"></button>
            <button class="carousel-dot w-3 h-3 bg-white/50 rounded-full"></button>
            <button class="carousel-dot w-3 h-3 bg-white/50 rounded-full"></button>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Featured Bags</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Sample Product 1 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <img src="{{ asset('images/bag1.jpg') }}" alt="Leather Handbag" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold">Black Prada Galleria Large Saffiano Leather Bag | PRADA</h3>
                        <p class="text-gray-600">8,499.00</p>
                        <a href="/shop" class="mt-3 inline-block bg-[#6B4226] hover:bg-[#4E2C1A] text-white px-4 py-2 rounded">
                            View Product
                        </a>
                    </div>
                </div>

                <!-- Sample Product 2 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <img src="{{ asset('images/bag2.jpg') }}" alt="Tote Bag" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold">Marc Jacobs The Medium Tote Bag - Black</h3>
                        <p class="text-gray-600">₱4,899.00</p>
                        <a href="/shop" class="mt-3 inline-block bg-[#6B4226] hover:bg-[#4E2C1A] text-white px-4 py-2 rounded">
                            View Product
                        </a>
                    </div>
                </div>

                <!-- Sample Product 3 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <img src="{{ asset('images/bag3.jpg') }}" alt="Crossbody Bag" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold">Miraggio crossbody bagsE</h3>
                        <p class="text-gray-600">₱1,499.00</p>
                        <a href="/shop" class="mt-3 inline-block bg-[#6B4226] hover:bg-[#4E2C1A] text-white px-4 py-2 rounded">
                            View Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const slides = document.querySelectorAll(".carousel-slide");
            const dots = document.querySelectorAll(".carousel-dot");
            let current = 0;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.style.opacity = i === index ? "1" : "0";
                    dots[i].classList.toggle("bg-white", i === index);
                    dots[i].classList.toggle("bg-white/50", i !== index);
                });
                current = index;
            }

            // Auto-slide every 5 seconds
            setInterval(() => {
                const next = (current + 1) % slides.length;
                showSlide(next);
            }, 5000);

            // Allow clicking dots to navigate
            dots.forEach((dot, i) => {
                dot.addEventListener("click", () => showSlide(i));
            });

            // Initialize
            showSlide(0);
        });
    </script>

@endsection
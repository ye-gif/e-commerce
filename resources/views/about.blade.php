@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cover bg-center h-[300px] md:h-[400px] flex items-center justify-center text-center text-white opacity-0 animate-fadeIn"
    style="background-image: url('{{ asset('images/hero-image.jpg') }}');">

    <!-- Gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-[#3d1f0f]/40 to-[#f9f6f2]/10"></div>

    <!-- Content -->
    <div class="relative z-10 px-6">
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-3 tracking-wide drop-shadow-lg">
            About Us
        </h1>
        <p class="text-base md:text-lg italic drop-shadow">
            Crafting excellence in every stitch
        </p>
    </div>
</section>

<!-- About Content -->
<section class="bg-[#f9f6f2] py-16 px-6 flex flex-col items-center border-t-[6px] border-[#d4a373]">
    <div class="max-w-3xl text-center text-gray-700 leading-relaxed space-y-6 text-[17px] animate-fadeInSlow">
        <p>
            At <span class="font-semibold text-[#4B0E0E]">Midnight Suede</span>, we believe that a handbag is more than just an accessory — 
            it's a statement of style, craftsmanship, and individuality.
        </p>

        <p>
            Since our founding, we've been committed to curating a collection of the finest designer handbags,
            each selected for its exceptional quality, timeless design, and unparalleled attention to detail.
        </p>

        <p>
            Our passion for luxury fashion drives us to bring you pieces that elevate your everyday style
            and stand the test of time. Whether you’re searching for a sophisticated tote or an elegant crossbody,
            every bag we offer reflects our dedication to artistry and modern refinement.
        </p>
    </div>
</section>
@endsection

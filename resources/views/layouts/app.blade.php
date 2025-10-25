<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Midnight Suede') }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-body">

    <nav x-data="{ open: false }" class="bg-navigation shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 text-white items-center">

                <div class="flex items-center space-x-6">
                    <a href="{{ url('/') }}" class="text-2xl font-extrabold text-white font-poppins hover:text-hover1 transition">
                        Midnight Suede
                    </a>

                    <div class="hidden space-x-8 sm:flex items-center">
                        <x-nav-link :href="url('/')" :active="request()->is('/')" class="text-white hover:text-hover1">
                            {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/shop')" :active="request()->is('shop')" class="text-white hover:text-hover1">
                            {{ __('Shop') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/about')" :active="request()->is('about')" class="text-white hover:text-hover1">
                            {{ __('About') }}
                        </x-nav-link>
                        @auth
                            <x-nav-link :href="route('dashboard')" :active="request()->is('dashboard')" class="text-white hover:text-hover1">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @endauth
                    </div>

                    <form action="{{ route('shop.index') }}" method="GET" class="hidden sm:flex items-center ms-4">
                        @if(request('category_id'))
                            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                        @endif
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search products..." 
                            class="px-3 py-1.5 rounded-l-md bg-[#f9f6f2] text-[#1b1410] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#D4A373] w-48 sm:w-64"
                        >
                        <button type="submit" class="bg-[#D4A373] hover:bg-[#c18b5f] text-[#1b1410] px-3 py-1.5 rounded-r-md font-semibold transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Right Section: Cart + Auth --}}
                <div class="hidden sm:flex sm:items-center sm:space-x-4">
                    {{-- Cart --}}
                    <x-nav-link :href="route('cart.index')" :active="request()->is('cart')" class="relative text-white hover:text-hover1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="w-6 h-6 hover:text-hover1 transition">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.293 2.293a1 1 0 00.707 1.707H19M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
                        </svg>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-2 -right-3 bg-hover1 text-white text-xs px-1.5 py-0.5 rounded-full">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </x-nav-link>

                    {{-- Profile Dropdown --}}
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-white hover:text-hover1 focus:outline-none transition">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('orders.index')">
                                    {{ __('My Orders') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endauth

                    {{-- Guest --}}
                    @guest
                        <a href="{{ route('login') }}" class="px-3 text-text hover:text-black">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-button text-text px-3 py-1 rounded hover:bg-secondary_button hover:text-black transition">
                            {{ __('Register') }}
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="p-6">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-[#1b1410] text-gray-300">
        @include('layouts.footer')
    </footer>
</body>
</html>

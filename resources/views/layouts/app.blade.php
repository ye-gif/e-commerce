<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Midnight Suede') }}</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
    @vite('resources/js/app.js') {{-- JavaScript (needed if using Alpine.js or Vue/React) --}}
</head>
<body class="bg-body">

    {{-- Navigation Bar --}}
    <nav x-data="{ open: false }" class="bg-navigation">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 text-white">
                <div class="flex">

                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-2xl font-extrabold text-white font-poppins hover:text-hover1 transition">
                            Midnight Suede
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="url('/')" :active="request()->is('/')" class="text-white hover:text-hover1">
                            {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/shop')" :active="request()->is('shop')" class="text-white hover:text-hover1">
                            {{ __('Shop') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/collection')" :active="request()->is('collection')" class="text-white hover:text-hover1">
                            {{ __('Collection') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/about')" :active="request()->is('about')" class="text-white hover:text-hover1">
                            {{ __('About') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Right side (Auth Links) -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        <!-- Dropdown for Authenticated Users -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black hover:text-purple-100 focus:outline-none transition">
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

                    @guest
                        <a href="{{ route('login') }}" class="px-3 text-text hover:text-black">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-button text-text px-3 py-1 rounded hover:bg-secondary_button hover:text-black transition">
                            {{ __('Register') }}
                        </a>
                    @endguest
                </div>

                <!-- Hamburger (Mobile) -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-pink-300 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-etherna text-white">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/shop')" :active="request()->is('shop')">
                    {{ __('Shop') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/collection')" :active="request()->is('collection')">
                    {{ __('Collection') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/about')" :active="request()->is('about')">
                    {{ __('About') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-pink-200">
                @auth
                    <div class="px-4">
                        <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                @endauth

                @guest
                    <div class="mt-3 space-y-1 px-4">
                        <x-responsive-nav-link :href="route('login')">
                            {{ __('Login') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="p-6">
        {{ $slot ?? '' }}
    </main>

    <!-- Page Content -->
    <main class="flex-1 p-8 bg-gray-50">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#1b1410] text-gray-300">
        @include('layouts.footer')
    </footer>
</body>
</html>

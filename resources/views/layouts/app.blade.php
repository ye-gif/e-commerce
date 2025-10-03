<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- ✅ Tailwind CSS --}}
    @vite('resources/css/app.css')

    {{-- ✅ JavaScript (needed if you’re using Alpine.js or Vue/React) --}}
    @vite('resources/js/app.js')
</head>
<body class="antialiased bg-gray-100">

    {{-- ✅ Navigation Bar --}}
    <nav x-data="{ open: false }" class="bg-gradient-to-r from-pink-400 via-pink-500 to-purple-400 border-b border-pink-300">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 text-white">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white drop-shadow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 2l3 7h7l-5.5 4.5L18 21l-6-4-6 4 1.5-7.5L2 9h7l3-7z" />
                            </svg>
                            <span class="text-xl font-bold tracking-wide drop-shadow">
                                <span class="text-white">Etherna</span> Wear
                            </span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="url('/')" :active="request()->is('/')" class="text-white hover:text-purple-100">
                            {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/shop')" :active="request()->is('shop')" class="text-white hover:text-purple-100">
                            {{ __('Shop') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/about')" :active="request()->is('about')" class="text-white hover:text-purple-100">
                            {{ __('About') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/contact')" :active="request()->is('contact')" class="text-white hover:text-purple-100">
                            {{ __('Contact') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Right side (Auth Links) -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        <!-- Dropdown for Authenticated Users -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-purple-100 focus:outline-none transition">
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
                        <a href="{{ route('login') }}" class="px-3 text-white hover:text-purple-100">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-pink-600 px-3 py-1 rounded hover:bg-purple-100 hover:text-pink-700 transition">
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
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gradient-to-r from-pink-400 via-pink-500 to-purple-400 text-white">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/shop')" :active="request()->is('shop')">
                    {{ __('Shop') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/about')" :active="request()->is('about')">
                    {{ __('About') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/contact')" :active="request()->is('contact')">
                    {{ __('Contact') }}
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

    {{-- ✅ Page Content --}}
    <main class="p-6">
        {{ $slot ?? '' }}
    </main>

</body>
</html>
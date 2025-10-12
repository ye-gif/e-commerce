<nav x-data="{ open: false }" class="bg-brown-dark border-b border-brown-medium">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 text-white">
            <div class="flex">
                
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="url('/')" :active="request()->is('/')" class="text-cream hover:text-gold">
                        {{ __('Home') }}
                    </x-nav-link>

                    <x-nav-link :href="url('/shop')" :active="request()->is('shop')" class="text-cream hover:text-gold">
                        {{ __('Shop') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="url('/collection')" :active="request()->is('collection')" class="text-white hover:text-hover1">
                        {{ __('Collection') }}
                    </x-nav-link>

                    <x-nav-link :href="url('/about')" :active="request()->is('about')" class="text-cream hover:text-gold">
                        {{ __('About') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side (Profile + Cart) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4 sm:ms-6">
                @auth
                    <!-- Profile Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-black hover:bg-white focus:outline-none transition duration-200 ease-in-out shadow-sm">
                                <div class="font-semibold tracking-wide drop-shadow-md">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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

                    <!-- 🛒 Cart beside Profile -->
                    <div class="relative" x-data="{ cartOpen: false }">
                        <button @click="cartOpen = !cartOpen" class="relative p-2 hover:bg-brown-medium rounded-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5-9v9m-4-9v9" />
                            </svg>
                            <span class="absolute -top-1 -right-1 bg-gold text-brown-dark text-xs font-bold rounded-full px-1.5">
                                {{ session('cart') ? count(session('cart')) : 0 }}
                            </span>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="cartOpen" @click.away="cartOpen = false"
                             class="absolute right-0 mt-2 w-64 bg-white text-brown-dark rounded-lg shadow-lg z-50 overflow-hidden"
                             x-transition>
                            <div class="p-4 border-b border-gray-200 font-semibold text-sm">
                                My Cart ({{ session('cart') ? count(session('cart')) : 0 }})
                            </div>

                            @if(session('cart') && count(session('cart')) > 0)
                                <ul class="max-h-56 overflow-y-auto divide-y divide-gray-100">
                                    @foreach(session('cart') as $id => $details)
                                        <li class="p-3 flex justify-between items-center text-sm">
                                            <span>{{ $details['name'] }}</span>
                                            <span class="text-gold">x{{ $details['quantity'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="p-3 border-t border-gray-200 text-center">
                                    <a href="{{ route('cart.index') }}" class="inline-block px-3 py-1 bg-brown-dark text-cream rounded hover:bg-gold hover:text-brown-dark transition">
                                        View Cart
                                    </a>
                                </div>
                            @else
                                <div class="p-4 text-center text-gray-500 text-sm">
                                    Your cart is empty.
                                </div>
                            @endif
                        </div>
                    </div>
                @endauth

                @guest
                    <div class="flex items-center gap-3">
                        <!-- Cart beside Login/Register -->
                        <a href="{{ route('cart.index') }}" class="relative p-2 hover:bg-brown-medium rounded-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5-9v9m-4-9v9" />
                            </svg>
                            <span class="absolute -top-1 -right-1 bg-gold text-brown-dark text-xs font-bold rounded-full px-1.5">
                                {{ session('cart') ? count(session('cart')) : 0 }}
                            </span>
                        </a>

                        <a href="{{ route('login') }}" class="px-4 py-2 bg-brown-medium text-white rounded hover:bg-rust transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-brown-dark text-cream rounded hover:bg-gold hover:text-brown-dark transition">
                            Register
                        </a>
                    </div>
                @endguest
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-brown-medium focus:outline-none transition duration-150 ease-in-out">
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-etherna text-cream">
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

            <!-- 🛒 Mobile Cart -->
            <x-responsive-nav-link :href="route('cart.index')">
                🛒 {{ __('My Cart') }} ({{ session('cart') ? count(session('cart')) : 0 }})
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

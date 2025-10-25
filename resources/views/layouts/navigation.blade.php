<nav x-data="{ open: false }" class="bg-brown-dark border-b border-brown-medium">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 text-white">
            <div class="flex items-center">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="url('/')" :active="request()->is('/')" class="text-cream hover:text-gold">
                        {{ __('Home') }}
                    </x-nav-link>

                    <x-nav-link :href="url('/shop')" :active="request()->is('shop')" class="text-cream hover:text-gold">
                        {{ __('Shop') }}
                    </x-nav-link>


                    <x-nav-link :href="url('/about')" :active="request()->is('about')" class="text-cream hover:bg-hover1">
                        {{ __('About') }}
                    </x-nav-link>
                </div>

                <!-- Search Box -->
                <form action="{{ route('shop.index') }}" method="GET" class="hidden sm:flex items-center ms-4">
                    @if(request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    @endif
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"  <!-- fixed comment issue -->
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

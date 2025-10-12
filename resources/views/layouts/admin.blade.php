<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="flex bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-midnight text-text min-h-screen flex flex-col">
        <div class="flex items-center space-x-3 border-b border-gray p-4">
            <img src="{{ asset('images/midnight.png') }}" 
                 alt="Midnight Suede" 
                 class="h-16 w-16 object-contain">
            <h1 class="text-lg font-semibold text-text">Midnight Suede</h1>
        </div>
        <nav class="mt-4 flex-1">
            <a href="/admin/dashboard" class="block py-2 px-4 hover:bg-hover">Dashboard</a>
            <a href="/admin/products" class="block py-2 px-4 hover:bg-hover">Products</a>
            <a href="/admin/categories" class="block py-2 px-4 hover:bg-hover">Categories</a>
            <a href="/admin/orders" class="block py-2 px-4 hover:bg-hover">Orders</a>
        </nav>
        <div class="mt-auto border-t border-brown-medium">
            <a href="/admin/profile"
            class="flex items-center py-3 px-4 hover:bg-hover {{ request()->is('admin/profile') ? 'bg-brown-medium text-gold' : '' }}">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-text" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>

                <span x-show="open" class="ml-3">Profile</span>
            </a>
        </div>


    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen overflow-y-auto">
        <!-- Topbar -->
        <header class="bg-midnight shadow p-4 flex justify-between items-center sticky top-0 z-10">
            <h1 class="text-text font-semibold">Admin Dashboard</h1>
            <div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-secondary_button hover:bg-hover1 text-black px-3 py-1 rounded">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-8 bg-gray-50">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-[#1b1410] text-gray-300">
            @include('layouts.footer')
        </footer>

    </div>

</body>
</html>
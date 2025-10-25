<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Panel</title>
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

        <!-- Navigation -->
        <nav class="mt-4 flex-1">
            <a href="/seller/dashboard" class="block py-2 px-4 hover:bg-hover">Dashboard</a>
            <a href="/seller/products" class="block py-2 px-4 hover:bg-hover">Products</a>
            <a href="/seller/categories" class="block py-2 px-4 hover:bg-hover">Categories</a>
            <a href="/seller/orders" class="block py-2 px-4 hover:bg-hover">Orders</a>
        </nav>

        <!-- Logout moved here -->
        <div class="mt-auto border-t border-brown-medium">
            <form method="POST" action="{{ route('logout') }}" class="flex items-center py-3 px-4 hover:bg-hover w-full">
                @csrf
                <button type="submit" class="flex items-center w-full text-left">
                    <!-- Logout Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-text" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen overflow-y-auto">
        <!-- Topbar -->
        <header class="bg-midnight shadow p-4 flex justify-between items-center sticky top-0 z-10">
            <h1 class="text-text font-semibold">Seller Dashboard</h1>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-8 bg-gray-50">
            @yield('content')
        </main>
    </div>
</body>
</html>

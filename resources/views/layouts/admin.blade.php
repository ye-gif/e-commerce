<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Etherna Wear</title>
    @vite('resources/css/app.css')
</head>
<body class="flex bg-[#F5E6D3] min-h-screen"> 
    
    <!-- Sidebar -->
    <aside class="w-64 bg-[#6B4226] text-white flex-shrink-0 flex flex-col">
        <div class="p-4 text-2xl font-bold border-b border-[#4E2C1A] h-16 flex items-center">
            Etherna Wear
        </div>
        <nav class="mt-4 flex-1">
            <a href="/admin/dashboard" 
               class="block py-2.5 px-4 rounded transition @if(request()->is('admin/dashboard')) bg-[#4E2C1A] @else hover:bg-[#4E2C1A] @endif">
               Dashboard
            </a>
            <a href="/admin/products" 
               class="block py-2.5 px-4 rounded transition @if(request()->is('admin/products*')) bg-[#4E2C1A] @else hover:bg-[#4E2C1A] @endif">
               Products
            </a>
            <a href="/admin/categories" 
               class="block py-2.5 px-4 rounded transition @if(request()->is('admin/categories*')) bg-[#4E2C1A] @else hover:bg-[#4E2C1A] @endif">
               Categories
            </a>
            <a href="/admin/orders" 
               class="block py-2.5 px-4 rounded transition @if(request()->is('admin/orders*')) bg-[#4E2C1A] @else hover:bg-[#4E2C1A] @endif">
               Orders
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto"> 
        
        <!-- Header -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center h-16 border-b border-[#D9C2A3]">
            <h1 class="text-xl font-semibold text-[#4E2C1A]">Admin Dashboard</h1>
            <div class="flex items-center gap-4">
                <span class="font-medium text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-[#6B4226] hover:bg-[#4E2C1A] text-white px-4 py-2 rounded-md text-sm transition">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 bg-[#F5E6D3] flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="p-4 bg-[#6B4226] text-center text-sm text-white">
            &copy; {{ date('Y') }} Etherna Wear. All rights reserved.
        </footer>
    </div>

</body>
</html>

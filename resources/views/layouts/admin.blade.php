<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
</head>
<body class="flex bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen">
        <div class="p-4 text-2xl font-bold border-b border-gray-700">
            Admin Panel
        </div>
        <nav class="mt-4">
            <a href="/admin/dashboard" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a>
            <a href="/admin/products" class="block py-2 px-4 hover:bg-gray-700">Products</a>
            <a href="/admin/categories" class="block py-2 px-4 hover:bg-gray-700">Categories</a>
            <a href="/admin/orders" class="block py-2 px-4 hover:bg-gray-700">Orders</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">Admin Dashboard</h1>
            <div>
                <span class="mr-4">{{ Auth::user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
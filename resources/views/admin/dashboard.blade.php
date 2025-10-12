@extends('layouts.admin') {{-- assuming your layout file is the one you shared above --}}

@section('content')
<div class="space-y-8">

    <!-- Dashboard Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold text-[#4E2C1A]">Dashboard Overview</h2>
        <a href="{{ route('admin.products.create') }}"
           class="bg-[#D4A373] hover:bg-[#c18b5f] text-[#1b1410] px-6 py-2 rounded-lg font-semibold shadow-md transition">
           + Add Product
        </a>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Products</h3>
            <p class="text-3xl font-bold text-[#6B4226]">{{ $productCount ?? 120 }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Orders</h3>
            <p class="text-3xl font-bold text-[#6B4226]">{{ $orderCount ?? 58 }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Revenue</h3>
            <p class="text-3xl font-bold text-[#6B4226]">₱{{ $revenue ?? '152,300' }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Users</h3>
            <p class="text-3xl font-bold text-[#6B4226]">{{ $userCount ?? 340 }}</p>
        </div>
    </div>

    <!-- Product Management -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-2xl font-semibold text-[#4E2C1A] mb-4">Recent Products</h3>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#f4ede5] text-left">
                    <th class="p-3 font-semibold">Image</th>
                    <th class="p-3 font-semibold">Product Name</th>
                    <th class="p-3 font-semibold">Category</th>
                    <th class="p-3 font-semibold">Price</th>
                    <th class="p-3 font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products ?? [] as $product)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-14 w-14 object-cover rounded">
                        </td>
                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->category->name ?? 'Uncategorized' }}</td>
                        <td class="p-3">₱{{ number_format($product->price, 2) }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if(empty($products) || count($products) === 0)
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            No products available yet. <a href="{{ route('admin.products.create') }}" class="text-[#D4A373] hover:underline">Add your first product</a>.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
@endsection

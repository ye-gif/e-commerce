@extends('layouts.seller')

@section('content')
<div class="seller-page">
  <div class="seller-header flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Products</h1>
    <a href="{{ route('seller.products.create') }}" class="btn btn-primary bg-[#4B0E0E] hover:bg-[#6A1B1B] text-white px-4 py-2 rounded-lg shadow">
      + Add New Product
    </a>
  </div>

  @vite(['resources/css/app.css', 'resources/css/seller.css', 'resources/js/app.js'])

  @if(session('success'))
    <div id="success-alert" class="bg-green-100 text-green-800 border border-green-400 p-3 rounded-md mb-4">
      {{ session('success') }}
    </div>

    <script>
      setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
          alert.style.transition = 'opacity 0.5s ease';
          alert.style.opacity = '0';
          setTimeout(() => alert.remove(), 500);
        }
      }, 3000);
    </script>
  @endif

  <div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="min-w-full border border-gray-200">
      <thead class="bg-[#4B0E0E] text-white">
        <tr>
          <th class="py-3 px-4 text-left">ID</th>
          <th class="py-3 px-4 text-left">Image</th>
          <th class="py-3 px-4 text-left">Product Name</th>
          <th class="py-3 px-4 text-left">Category</th>
          <th class="py-3 px-4 text-left">Price</th>
          <th class="py-3 px-4 text-left">Stock</th>
          <th class="py-3 px-4 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($products as $product)
        <tr class="border-b hover:bg-gray-50">
          <td class="py-3 px-4">{{ $product->id }}</td>
          <td class="py-3 px-4">
            @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" 
                alt="{{ $product->name }}" 
                class="w-16 h-16 object-cover rounded">
            @else
            <span class="text-gray-400 italic">No image</span>
            @endif

          </td>
          <td class="py-3 px-4 font-medium text-gray-700">{{ $product->name }}</td>
          <td class="py-3 px-4 text-gray-600">{{ $product->category->name ?? 'Uncategorized' }}</td>
          <td class="py-3 px-4 text-gray-600">₱{{ number_format($product->price, 2) }}</td>
          <td class="py-3 px-4 text-gray-600">{{ $product->stock }}</td>
          <td class="py-3 px-4 text-center">
            <div class="flex justify-center gap-2">
              <a href="{{ route('seller.products.show', $product->id) }}" class="bg-[#6A1B1B] hover:bg-[#4B0E0E] text-white px-3 py-1 rounded-md text-sm">
                View
              </a>
              <a href="{{ route('seller.products.edit', $product->id) }}" class="bg-footer hover:bg-hover1 text-white px-3 py-1 rounded-md text-sm">
                Edit
              </a>
              <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-text1 hover:bg-hover text-white px-3 py-1 rounded-md text-sm">
                  Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="py-4 text-center text-gray-500">No products found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

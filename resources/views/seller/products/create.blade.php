@extends('layouts.seller')

@section('content')
<div class="seller-page flex justify-center items-center py-10">
  <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-3xl border border-[#e4d8d8]">
    
    {{-- Header --}}
    <div class="text-center mb-6">
      <h2 class="text-2xl font-bold text-[#4B0E0E] uppercase">Add New Product</h2>
      <p class="text-gray-500 text-sm mt-1">Fill out the details below to add a new product.</p>
    </div>

    {{-- Success Message --}}
    @if(session('success') && request()->is('seller/*'))
      <div id="success-message" class="bg-green-100 text-green-700 border border-green-400 rounded-md px-4 py-3 text-center mb-4">
        {{ session('success') }}
      </div>
      <script>
        setTimeout(() => {
          const msg = document.getElementById('success-message');
          if (msg) msg.style.display = 'none';
        }, 3000);
      </script>
    @endif

    {{-- Product Form --}}
    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf

      {{-- Product Name --}}
      <div>
        <label for="name" class="block text-sm font-semibold text-[#4B0E0E] mb-1">
          Product Name <span class="text-red-600">*</span>
        </label>
        <input 
          type="text" 
          name="name" 
          id="name"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-[#4B0E0E] focus:border-[#4B0E0E]" 
          placeholder="Enter product name" 
          required>
      </div>

      {{-- Description --}}
      <div>
        <label for="description" class="block text-sm font-semibold text-[#4B0E0E] mb-1">
          Description <span class="text-red-600">*</span>
        </label>
        <textarea 
          name="description" 
          id="description" 
          rows="4"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-[#4B0E0E] focus:border-[#4B0E0E]" 
          placeholder="Enter product description" 
          required></textarea>
      </div>

      {{-- Price --}}
      <div>
        <label for="price" class="block text-sm font-semibold text-[#4B0E0E] mb-1">
          Price <span class="text-red-600">*</span>
        </label>
        <input 
          type="number" 
          name="price" 
          id="price"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-[#4B0E0E] focus:border-[#4B0E0E]" 
          placeholder="Enter product price" 
          step="0.01" 
          required>
      </div>

      {{-- Stock --}}
      <div>
        <label for="stock" class="block text-sm font-semibold text-[#4B0E0E] mb-1">
          Stock <span class="text-red-600">*</span>
        </label>
        <input 
          type="number" 
          name="stock" 
          id="stock"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-[#4B0E0E] focus:border-[#4B0E0E]" 
          placeholder="Enter stock quantity" 
          required>
      </div>

      {{-- Category --}}
      <div>
        <label for="category_id" class="block text-sm font-semibold text-[#4B0E0E] mb-1">
          Category <span class="text-red-600">*</span>
        </label>
        <select 
          name="category_id" 
          id="category_id" 
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-[#4B0E0E] focus:border-[#4B0E0E]" 
          required>
          <option value="">Select a category</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      {{-- Product Image --}}
      <div>
        <label for="image" class="block text-sm font-semibold text-[#4B0E0E] mb-1">
          Product Image <span class="text-red-600">*</span>
        </label>
        <input 
          type="file" 
          name="image" 
          id="image"
          accept="image/*"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-[#4B0E0E] focus:border-[#4B0E0E]" 
          required>
      </div>

      {{-- Buttons --}}
      <div class="flex justify-between items-center pt-4">
        <a href="{{ route('seller.products.index') }}" 
           class="px-4 py-2 border border-gray-400 text-gray-600 rounded-md hover:bg-gray-100 transition">
          Cancel
        </a>
        <button type="submit" 
                class="bg-[#4B0E0E] hover:bg-[#6A1B1B] text-white px-6 py-2 rounded-md font-medium shadow transition">
            Save Product
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@extends('layouts.seller')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-8 mt-10 border border-gray-200">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit Product</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-6">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-1">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-hero focus:border-hero"
                   placeholder="Enter product name">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2  focus:ring-hero focus:border-hero"
                      placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Price (₱)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2  focus:ring-hero focus:border-hero">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2  focus:ring-hero focus:border-hero">
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Category</label>
            <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2  focus:ring-hero focus:border-hero">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if($product->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Product Image</label>
            <input type="file" name="image" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2  focus:ring-hero focus:border-hero">

            @if($product->image)
                <div class="mt-4 flex items-center gap-4">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                    alt="{{ $product->name }}" 
                         class="w-24 h-24 object-cover rounded-lg border border-gray-300 shadow-sm" alt="Current Image">
                    <span class="text-gray-500 text-sm">Current Image</span>
                </div>
            @endif
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('seller.products.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg font-medium transition mr-3">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-midnight hover:bg-hover text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection

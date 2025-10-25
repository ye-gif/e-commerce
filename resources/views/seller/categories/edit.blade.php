@extends('layouts.seller')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md p-8 mt-10 border border-gray-200">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit Category</h1>

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-6">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Category Form --}}
    <form action="{{ route('seller.categories.update', $category->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Category Name --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Category Name</label>
            <input type="text" name="name" 
                   value="{{ old('name', $category->name) }}" 
                   placeholder="Enter category name"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-hero focus:border-hero">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Description</label>
            <textarea name="description"
                      rows="3"
                      placeholder="Enter category description"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-hero focus:border-hero">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('seller.categories.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg font-medium transition mr-3">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-button1 hover:bg-headings text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
                Update Category
            </button>
        </div>
    </form>
</div>
@endsection

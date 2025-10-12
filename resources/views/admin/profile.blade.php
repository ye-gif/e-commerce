@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-8 mt-10">
    <div class="flex items-center space-x-4">
        <!-- Profile Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-brown-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>

        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h1>
            <p class="text-gray-500">{{ Auth::user()->email }}</p>
        </div>
    </div>

    <hr class="my-6 border-gray-300">

    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Account Information</h2>
        <ul class="space-y-2 text-gray-600">
            <li><strong>Role:</strong> Admin</li>
            <li><strong>Member Since:</strong> {{ Auth::user()->created_at->format('F d, Y') }}</li>
        </ul>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Forgot Password</h2>
    @if (session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('status') }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <label for="email" class="block mb-2 font-medium text-gray-700">Email address</label>
        <input type="email" name="email" id="email" required
               class="w-full border border-gray-300 p-2 rounded mb-4">

        @error('email')
            <div class="text-red-600 mb-4">{{ $message }}</div>
        @enderror

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Send Reset Link
        </button>
    </form>
</div>
@endsection

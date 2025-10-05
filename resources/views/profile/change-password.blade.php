<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Change Password
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white p-6 shadow rounded-lg">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="mb-4">
                    <label for="current_password" class="block font-medium">Current Password</label>
                    <input type="password" name="current_password" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-medium">New Password</label>
                    <input type="password" name="password" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded p-2">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Update Password
                </button>

                <a href="{{ route('dashboard') }}" 
                    class="bg-gray-200 text-black px-4 py-2 rounded inline-block text-center">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</x-app-layout>
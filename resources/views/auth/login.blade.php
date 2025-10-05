<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-[#6B4226] to-[#4E2C1A]">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-xl">
            
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Etherna Wear Logo" class="h-14">
            </div>

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center text-[#4E2C1A]">Welcome Back</h2>
            <p class="text-center text-gray-600 mt-2">Login to manage Etherna Wear</p>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#6B4226] shadow-sm focus:ring-[#6B4226]">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-[#6B4226] hover:underline">Forgot password?</a>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit" class="w-full bg-[#6B4226] hover:bg-[#4E2C1A] text-white py-2 px-4 rounded-lg shadow-md transition">
                        Login
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            <p class="mt-6 text-center text-sm text-gray-600">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-[#6B4226] font-medium hover:underline">Register</a>
            </p>
        </div>
    </div>
</x-guest-layout>

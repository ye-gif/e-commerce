<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-[#6B4226] to-[#4E2C1A]">
        <div class="bg-white p-8 rounded-xl shadow-2xl text- center"> 
            <img src="{{ asset('images/midnight.png') }}" alt="Midnight Suede" class="h-23 w-30">

            <h2 class="text-2xl font-bold text-center text-[#4E2C1A]">Create an Account</h2>
            <p class="text-center text-gray-600 mt-2">Join Midnight Suede today!</p>

            <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" type="text" name="name" required autofocus
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
                </div>

                <!-- Confirm -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit" class="w-full bg-[#6B4226] hover:bg-[#4E2C1A] text-white py-2 px-4 rounded-lg shadow-md transition">
                        Register
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#6B4226] font-medium hover:underline">Login</a>
            </p>
        </div>
    </div>
</x-guest-layout>

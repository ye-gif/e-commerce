<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-8 bg-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-[#4E2C1A]">Create an Account</h2>
        <p class="text-center text-gray-600 mt-2">Join Midnight Suede today!</p>

        <!-- Display status -->
        @if (session('status'))
            <div class="mt-4 text-green-600 font-medium text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="mt-4 text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Account Type</label>
                <select id="role" name="role" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#6B4226] focus:border-[#6B4226]">
                    <option value="customer" {{ old('role')=='customer' ? 'selected' : '' }}>Customer</option>
                    <option value="seller" {{ old('role')=='seller' ? 'selected' : '' }}>Seller</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-[#6B4226] hover:bg-[#4E2C1A] text-white py-2 px-4 rounded-lg shadow-md transition">
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-[#6B4226] font-medium hover:underline">Login</a>
        </p>
    </div>
</x-guest-layout>

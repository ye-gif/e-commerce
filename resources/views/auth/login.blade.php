<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
            
            <!-- Logo -->
            <div class="text-center mb-6">
                <img src="{{ asset('images/midnight.png') }}" alt="Midnight Suede" class="h-20 w-20 mx-auto mb-3">
                <h2 class="text-2xl font-semibold text-[#4b2e05]">Welcome Back</h2>
                <p class="text-sm text-gray-500">Log in to your Midnight Suede account</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#4b2e05] focus:border-[#4b2e05]" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#4b2e05] focus:border-[#4b2e05]"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#4b2e05] shadow-sm focus:ring-[#4b2e05]" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#4b2e05] hover:underline">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div>
                    <x-primary-button class="w-full justify-center bg-[#4b2e05] hover:bg-[#5c3b0a] text-white font-medium py-2 rounded-lg transition duration-150 ease-in-out">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <p class="mt-6 text-center text-sm text-gray-600">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="text-[#4b2e05] font-semibold hover:underline">
                            {{ __('Register') }}
                        </a>
                    </p>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout>

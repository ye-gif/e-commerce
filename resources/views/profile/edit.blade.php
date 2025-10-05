<x-app-layout>
    <div class="max-w-2xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

        <form method="POST" action="{{ route('profile.edit') }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- User Info -->
                <div class="bg-gray-50 p-4 rounded-lg shadow">
                    <h3 class="font-semibold text-lg mb-2">Personal Information</h3>
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Member since:</strong> {{ Auth::user()->created_at->format('F d, Y') }}</p>
                </div>
                            
            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-2">Actions</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">
                                Edit Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('password.change') }}" class="text-blue-600 hover:underline">
                                Change Password
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
            </div>

            <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">
                Save Changes
            </button>
        </form>
    </div>
</x-app-layout>
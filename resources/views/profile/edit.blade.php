<x-app-layout>
    <div class="max-w-2xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block font-medium">Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', Auth::user()->name) }}"
                       class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium">Email</label>
                <input type="email" name="email" id="email"
                       value="{{ old('email', Auth::user()->email) }}"
                       class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">
                Save Changes
            </button>
        </form>
    </div>
</x-app-layout>
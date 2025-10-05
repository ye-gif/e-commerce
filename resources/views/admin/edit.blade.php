<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="main-content-area">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Update Admin Info -->
            <div class="stat-card border-blue-500">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Update Information</h3>
                <div class="max-w-xl">
                    @include('admin.partials.update-admin-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="stat-card border-yellow-500">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Change Password</h3>
                <div class="max-w-xl">
                    @include('admin.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User -->
            <div class="stat-card border-red-500">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Delete Account</h3>
                <div class="max-w-xl">
                    @include('admin.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
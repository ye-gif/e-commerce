<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @extends('layouts.admin')

                        @section('content')
                        <h2 class="text-2xl font-bold mb-4">Welcome to the Admin Dashboard</h2>
                        <p class="text-gray-700">Here you can manage products, categories, and orders.</p>
                    @endsection
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
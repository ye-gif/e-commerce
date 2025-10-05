@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="p-6 bg-white rounded-lg shadow border-b-4 border-[#6B4226]">
        <h3 class="text-lg font-semibold text-[#4E2C1A]">Total Products</h3>
        <p class="text-3xl font-bold text-[#6B4226] mt-2">120</p>
    </div>
    <div class="p-6 bg-white rounded-lg shadow border-b-4 border-[#4E2C1A]">
        <h3 class="text-lg font-semibold text-[#4E2C1A]">Orders</h3>
        <p class="text-3xl font-bold text-[#6B4226] mt-2">450</p>
    </div>
    <div class="p-6 bg-white rounded-lg shadow border-b-4 border-[#D9C2A3]">
        <h3 class="text-lg font-semibold text-[#4E2C1A]">Customers</h3>
        <p class="text-3xl font-bold text-[#6B4226] mt-2">320</p>
    </div>
    <div class="p-6 bg-white rounded-lg shadow border-b-4 border-[#6B4226]">
        <h3 class="text-lg font-semibold text-[#4E2C1A]">Revenue</h3>
        <p class="text-3xl font-bold text-[#6B4226] mt-2">$12,450</p>
    </div>
</div>
@endsection

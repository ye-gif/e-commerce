@extends('layouts.app')


@section('content')
<style>
    footer {
        display: none !important;
    }
</style>

<div id="successPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 p-4">
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 text-center animate-fadeIn">

        <button id="closePopup" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="flex justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-green-600 mb-2">Order Placed Successfully!</h1>

        {{-- Message --}}
        <p class="text-gray-700 mb-6">
            Thank you for shopping with us! Your order has been placed and will be processed soon.
        </p>

        {{-- Buttons --}}
        <div class="flex justify-center space-x-4">
            <a href="{{ route('orders.index') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                View My Orders
            </a>
            <a href="{{ url('/') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Back to Home
            </a>
        </div>
    </div>
</div>

{{-- animation --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.8); }
    to { opacity: 1; transform: scale(1); }
}
.animate-fadeIn {
    animation: fadeIn 0.3s ease-out forwards;
}
</style>

{{-- Close popup JS --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById('successPopup');
    const closeBtn = document.getElementById('closePopup');

    closeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    // Optional: click outside to close
    popup.addEventListener('click', (e) => {
        if (e.target === popup) {
            popup.style.display = 'none';
        }
    });
});
</script>
@endsection


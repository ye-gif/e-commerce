@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">

    {{-- Back to Shop --}}
    <a href="{{ route('shop.index') }}" 
       class="inline-flex items-center text-[#4E342E] hover:text-[#3E2723] mb-6 font-medium transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
             class="w-5 h-5 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
        Back to Shop
    </a>

    <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

    @if(empty($cart) || count($cart) == 0)
        <div class="text-center py-20">
            <p class="text-gray-500 mb-4">Your cart is empty</p>
            <a href="{{ route('shop.index') }}" 
               class="mt-4 inline-block bg-[#4E342E] hover:bg-[#3E2723] text-white px-6 py-2 rounded-full text-sm font-medium transition hover:-translate-y-1">
                Continue Shopping
            </a>
        </div>
    @else
        <form id="checkoutForm" method="GET" action="{{ route('checkout.index') }}">
            @csrf

            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-center">
                                <input type="checkbox" id="selectAll" class="w-4 h-4 accent-[#D4A373]">
                            </th>
                            <th class="px-6 py-3 text-left">Product</th>
                            <th class="px-6 py-3 text-center">Price</th>
                            <th class="px-6 py-3 text-center">Quantity</th>
                            <th class="px-6 py-3 text-center">Subtotal</th>
                            <th class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($cart as $id => $item)
                            <tr>
                                <td class="px-6 py-4 text-center">
                                    <input 
                                        type="checkbox" 
                                        class="itemCheckbox w-4 h-4 accent-[#D4A373]"
                                        data-id="{{ $id }}"
                                        data-price="{{ $item['price'] ?? 0 }}" 
                                        data-quantity="{{ $item['quantity'] ?? 1 }}"
                                    >
                                </td>
                                <td class="px-6 py-4 flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . ($item['image'] ?? 'default.jpg')) }}" 
                                    alt="{{ $item['name'] ?? 'Product Image' }}" 
                                    class="w-16 h-16 object-cover rounded-lg shadow-sm">

                                    <div>
                                        <p class="font-semibold">{{ $item['name'] ?? 'Unknown Product' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">₱{{ number_format($item['price'], 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ $item['quantity'] }}</td>
                                <td class="px-6 py-4 text-center font-semibold">
                                    ₱{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-midnight hover:text-hover1">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex justify-between items-center border-t pt-6">
                <p class="font-semibold text-lg">
                    Selected Total: ₱<span id="selectedTotal">0.00</span>
                </p>
                <button type="submit" 
                        id="checkoutBtn"
                        class="bg-button1 text-white px-6 py-3 rounded hover:bg-hover1 transition disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                        Checkout
                </button>
            </div>
        </form>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.itemCheckbox');
    const totalDisplay = document.getElementById('selectedTotal');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const checkoutForm = document.getElementById('checkoutForm');

    function updateTotal() {
        let total = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                const price = parseFloat(cb.dataset.price) || 0;
                const qty = parseInt(cb.dataset.quantity) || 1;
                total += price * qty;
            }
        });
        totalDisplay.textContent = total.toLocaleString('en-PH', { minimumFractionDigits: 2 });
        checkoutBtn.disabled = total <= 0;
    }

    selectAll.addEventListener('change', () => {
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
        updateTotal();
    });

    checkboxes.forEach(cb => cb.addEventListener('change', () => {
        if (!cb.checked) selectAll.checked = false;
        updateTotal();
    }));

    checkoutForm.addEventListener('submit', (e) => {
        const selected = Array.from(checkboxes)
                              .filter(cb => cb.checked)
                              .map(cb => cb.dataset.id);

        if(selected.length === 0){
            e.preventDefault();
            alert('Please select at least one product to checkout.');
            return;
        }

        // Add hidden inputs for selected items
        const oldInputs = checkoutForm.querySelectorAll('input[name="selected_items[]"]');
        oldInputs.forEach(i => i.remove());

        selected.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_items[]';
            input.value = id;
            checkoutForm.appendChild(input);
        });
    });

    updateTotal();
});
</script>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = Session::get('cart', []);

       
        $selectedIds = $request->input('selected_items', []);
        $items = array_filter($cart, fn($key) => in_array($key, $selectedIds), ARRAY_FILTER_USE_KEY);

        return view('checkout.index', compact('items'));
    }

    public function process(Request $request)
    {
        $cart = Session::get('cart', []);
        $selectedIds = $request->input('selected_items', []);

        if (empty($selectedIds)) {
            return redirect()->route('cart.index')->with('error', 'No items selected for checkout.');
        }

        $selectedItems = array_filter($cart, fn($key) => in_array($key, $selectedIds), ARRAY_FILTER_USE_KEY);

        if (empty($selectedItems)) {
            return redirect()->route('cart.index')->with('error', 'Selected items not found.');
        }

        $order = Order::create([
        'user_id' => Auth::id(),
        'full_name' => $request->input('full_name'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        'payment_method' => $request->input('payment_method'),
        'status' => 'Confirmed',
        'total_price' => collect($selectedItems)->sum(fn($item) => $item['price'] * $item['quantity']),
]);

        foreach ($selectedItems as $itemId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $itemId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        foreach ($selectedIds as $id) {
            unset($cart[$id]);
        }

        Session::put('cart', $cart);

        return redirect()->route('checkout.complete', ['order_id' => $order->id]);
    }


    public function complete(Request $request)
    {
        $orderId = $request->query('order_id');

        return redirect()->route('checkout.success')->with('order_id', $orderId);
    }

    public function success()
    {
        $orderId = session('order_id');
        if (!$orderId) {
            return redirect()->route('shop.index')->with('error', 'No recent order found.');
        }

        return view('checkout.success', compact('orderId'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $quantity = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image ?? 'no-image.png',
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        $validated = $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $id = $validated['id'];
        $quantity = $validated['quantity'];

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);

            $subtotal = $cart[$id]['price'] * $quantity;

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $id,
                    'quantity' => $quantity,
                    'subtotal' => number_format($subtotal, 2),
                    'cart_total' => number_format(
                        collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
                        2
                    ),
                ]);
            }

            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart.'], 404);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item removed successfully!');
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }

    public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->input('id');
        $quantity = max(1, (int)$request->input('quantity'));

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);

            $subtotal = $cart[$id]['price'] * $quantity;
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

            return response()->json([
                'success' => true,
                'id' => $id,
                'quantity' => $quantity,
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($total, 2)
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart.'], 404);
    }

    public function checkoutSuccess()
    {
        session()->forget('cart');
        return redirect()->route('orders.index')->with('success', 'Order placed successfully and cart cleared!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $orders = Order::where('user_id', $user->id)
            ->with(['orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Your order has been cancelled successfully.');
    }

    public function sellerOrders()
    {

        $orders = Order::with('user')
            ->select('id', 'user_id', 'total_price', 'payment_method', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('seller.dashboard', compact('orders'));
    }
}

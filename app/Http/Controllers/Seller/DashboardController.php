<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();

        // Total products owned by this seller
        $productCount = Product::where('seller_id', $sellerId)->count();

        // Total orders containing this seller’s products
        $orderCount = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->distinct('order_id')->count('order_id');

        // Total revenue for this seller
        $revenue = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->sum('subtotal');

        // Total users (customers)
        $userCount = User::where('role', 'customer')->count();

        // Recent orders containing seller’s products
        $recentOrders = OrderItem::whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->with(['order', 'product'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'id' => $item->order_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'total' => $item->subtotal,
                    'status' => $item->order->status,
                ];
            });

        return view('seller.dashboard', compact(
            'productCount',
            'orderCount',
            'revenue',
            'userCount',
            'recentOrders'
        ));
    }
}

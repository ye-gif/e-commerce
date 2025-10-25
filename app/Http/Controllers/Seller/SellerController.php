<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();

        // Count products owned by seller
        $productCount = Product::where('seller_id', $sellerId)->count();

        // Count orders that contain seller's products
        $orderCount = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->distinct('order_id')->count('order_id');

        // Sum revenue from seller’s sold items
        $revenue = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->sum('subtotal');

        $userCount = User::where('role', 'user')->count();

        // Get recent 5 orders with this seller’s products
        $recentOrders = OrderItem::whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->with(['order', 'product'])
            ->latest()
            ->take(5)
            ->get();

        return view('seller.dashboard', compact(
            'productCount', 'orderCount', 'revenue', 'userCount', 'recentOrders'
        ));
    }
}

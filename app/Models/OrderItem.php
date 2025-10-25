<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'subtotal',
    ];

    // Each order item belongs to one order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // ✅ Add this relationship to fix the error
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    // To calculate subtotal directly
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}

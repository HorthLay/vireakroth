<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'image', 'category_id', 'quantity_sold', 'status', 'discount'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDiscountedPrice()
    {
        return $this->price - ($this->price * ($this->discount / 100));
    }


    // Define the relationship with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

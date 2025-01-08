<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id', // Add customer_id if needed
        'quantity',
        'total_price',  // Add product_id if needed
        'details', // Add this field
        'status',
        'order_booking_date' // Include status if it's relevant
        // Add any other fields you want to be mass assignable
    ];


    protected $casts = [
        'items' => 'array', // Cast items to array
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = $value ?? Carbon::now();
    }



    // Define the relationship with customer
}

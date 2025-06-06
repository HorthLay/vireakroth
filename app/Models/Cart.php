<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'discount',
        'total_price',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

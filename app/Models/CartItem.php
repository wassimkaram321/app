<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];
    protected $casts = [
        'cart_id'    => 'integer',
        'product_id' => 'integer',
        'quantity'   => 'integer',
    ];
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

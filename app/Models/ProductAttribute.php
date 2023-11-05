<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    public $table = 'product_attributes';
    protected $fillable = [
        'attribute_id',
        'product_id',
        'selected_value',
        'quantity'
    ];
    protected $casts = [
        'attribute_id'   => 'integer',
        'product_id'     => 'integer',
        'quantity'       => 'integer',
        'selected_value' => 'integer',
    ];
    public function product()
    {
        return $this->hasMany(Product::class,'product_attributes');
    }
}

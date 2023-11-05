<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'is_active',
        'product_category_id',
    ];
    protected $casts = [
        'name'                => 'string',
        'is_active'           => 'boolean',
        'product_category_id' => 'integer',
    ];
    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }
    public function products()
    {
        return $this->morphMany(Product::class, 'categorizable');
    }
}

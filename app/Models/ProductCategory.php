<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'is_active'
    ];
    protected $casts = [
        'name'        => 'string',
        'is_active'   => 'boolean',
    ];
    public function products()
    {
        return $this->morphMany(Product::class, 'categorizable');
    }
    public function productSubCategories()
    {
        return $this->hasMany(ProductSubCategory::class);
    }
}

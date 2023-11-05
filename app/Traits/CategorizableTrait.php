<?php
namespace App\Traits;
use Illuminate\Support\Str;

trait CategorizableTrait
{
    public function getCategoryClass($category)
    {
        switch ($category) {
            case 'Category':
                return 'App\Models\ProductCategory';
            case 'Subcategory':
                return 'App\Models\ProductSubCategory';
            default:
                return 'Unknown';
        }
    }
}

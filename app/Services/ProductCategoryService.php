<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\ProductCategory;

class ProductCategoryService
{
    use ModelHelper;
    public function __construct(private ProductCategory $productCategory)
    {
    }
    public function getAll()
    {
        if(request()->has('page'))
            return $this->productCategory->paginate(request()->items_per_page);
        return $this->productCategory->all();
    }

    public function find($product_categoryId)
    {
        return $this->findByIdOrFail(ProductCategory::class,'product_category', $product_categoryId);
    }
    public function getCategoryWithProducts($product_categoryId)
    {
        return $this->find($product_categoryId)->with(['products','productSubCategories'])->first();
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $product_category = $this->productCategory->create($validatedData);

        DB::commit();

        return $product_category;
    }

    public function update($validatedData, $product_categoryId)
    {
        $product_category = $this->find($product_categoryId);

        DB::beginTransaction();

        $product_category->update($validatedData);

        DB::commit();

        return true;
    }


    public function delete($product_categoryId)
    {
        $product_category = $this->find($product_categoryId);

        DB::beginTransaction();

        $product_category->delete();

        DB::commit();

        return true;
    }
    public function updateStatus($validatedData, $product_categoryId)
    {
        $product_category = $this->find($product_categoryId);

        DB::beginTransaction();

        $product_category->update($validatedData);

        DB::commit();

        return true;
    }
}

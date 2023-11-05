<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\ProductSubCategory;

class ProductSubCategoryService
{
    use ModelHelper;
    public function __construct(private ProductSubCategory $productSubCategory)
    {
    }
    public function getAll()
    {
        if(request()->has('page'))
            return $this->productSubCategory->paginate(request()->items_per_page);
        return $this->productSubCategory->all();
    }

    public function find($product_sub_categoryId)
    {
        return $this->findByIdOrFail(ProductSubCategory::class,'product_sub_category', $product_sub_categoryId);
    }
    public function getSubCategoryWithProducts($product_sub_categoryId)
    {

        return $this->productSubCategory->whereid($product_sub_categoryId)->with(['products','category'])->first();
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $product_sub_category = $this->productSubCategory->create($validatedData);

        DB::commit();

        return $product_sub_category;
    }

    public function update($validatedData, $product_sub_categoryId)
    {
        $product_sub_category = $this->find($product_sub_categoryId);

        DB::beginTransaction();

        $product_sub_category->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($product_sub_categoryId)
    {
        $product_sub_category = $this->find($product_sub_categoryId);

        DB::beginTransaction();

        $product_sub_category->delete();

        DB::commit();

        return true;
    }
    public function updateStatus($validatedData, $product_sub_categoryId)
    {
        $product_sub_category = $this->find($product_sub_categoryId);

        DB::beginTransaction();

        $product_sub_category->update($validatedData);

        DB::commit();

        return true;
    }
}

<?php

namespace App\Services;

use App\Models\Attribute;
use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Traits\ProductDataTrait;
use App\Traits\UploadImageTrait;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Traits\CategorizableTrait;
use Ramsey\Uuid\Nonstandard\Uuid;

class ProductService
{
    use ModelHelper, CategorizableTrait , ProductDataTrait , UploadImageTrait;
    public function __construct
    (
        private ProductAttributeService $productAttributeService ,
        private FeatureService $featureService,
        private Product $product,
    )
    {
    }
    public function getAll()
    {
        if(request()->has('page'))
            return $this->product->paginate(request()->items_per_page);
        return $this->product->filter()->get();
    }

    public function find($productId)
    {
        return $this->product->find($productId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $validatedData = $this->preperData($validatedData);

        $product = $this->product->create($validatedData);

        $this->productAttributeService->createMany($product,$validatedData);

        $this->featureService->createMany($product,$validatedData);

        if(request()->has('image'))
            $this->uploadImage($product,request()->image,'products');
        if(request()->has('images'))
            $this->uploadImages($product,request()->images,'product-images');


        DB::commit();

        return $product;
    }

    public function update($validatedData, $productId)
    {
        $product = $this->find($productId);

        DB::beginTransaction();

        $validatedData = $this->preperData($validatedData);

        $this->productAttributeService->createMany($product,$validatedData);

        $this->featureService->createMany($product,$validatedData);

        $product->update($validatedData);

        if(request()->has('image'))
            $this->uploadImage($product,request()->image,'products');
        if(request()->has('images'))
            $this->uploadImages($product,request()->images,'product-images');

        DB::commit();

        return true;
    }

    public function delete($productId)
    {
        $product = $this->find($productId);

        DB::beginTransaction();

        $product->delete();

        DB::commit();

        return true;
    }



    public function updateStatus($validatedData, $productId)
    {
        $product = $this->find($productId);

        DB::beginTransaction();

        $product->update($validatedData);

        DB::commit();

        return true;
    }
}

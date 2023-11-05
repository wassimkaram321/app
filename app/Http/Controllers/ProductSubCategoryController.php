<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSubCategoryRequest;
use App\Http\Resources\ProductSubCategoryResource;
use App\Services\ProductSubCategoryService;

class ProductSubCategoryController extends Controller
{
    public function __construct(private ProductSubCategoryService $product_sub_categoryService)
    {
    }

    public function getAll()
    {
        $product_sub_categories = $this->product_sub_categoryService->getAll();
        return $this->successResponse(
            $this->resource($product_sub_categories, ProductSubCategoryResource::class),
            ''
        );
    }

    public function find($product_sub_categoryId)
    {
        $product_sub_category = $this->product_sub_categoryService->find($product_sub_categoryId);

        return $this->successResponse(
            $this->resource($product_sub_category, ProductSubCategoryResource::class),
            ''
        );
    }
    public function getSubCategoryWithProducts($product_sub_categoryId)
    {
        $product_sub_category = $this->product_sub_categoryService->getSubCategoryWithProducts($product_sub_categoryId);
        return $this->successResponse(
            $this->resource($product_sub_category, ProductSubCategoryResource::class),
            ''
        );
    }

    public function create(ProductSubCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $product_sub_category = $this->product_sub_categoryService->create($validatedData);

        return $this->successResponse(
            $this->resource($product_sub_category, ProductSubCategoryResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(ProductSubCategoryRequest $request, $product_sub_categoryId)
    {
        $validatedData = $request->validated();
        $this->product_sub_categoryService->update($validatedData, $product_sub_categoryId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($product_sub_categoryId)
    {
        $this->product_sub_categoryService->delete($product_sub_categoryId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
    public function updateStatus(ProductSubCategoryRequest $request, $product_sub_categoryId)
    {
        $validatedData = $request->validated();
        $this->product_sub_categoryService->updateStatus($validatedData, $product_sub_categoryId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }
}

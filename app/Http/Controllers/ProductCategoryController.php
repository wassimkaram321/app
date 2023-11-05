<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Http\Resources\ProductCategoryResource;
use App\Services\ProductCategoryService;

class ProductCategoryController extends Controller
{
    public function __construct(private ProductCategoryService $product_categoryService)
    {
    }

    public function getAll()
    {
        $product_categories = $this->product_categoryService->getAll();
        return $this->successResponse(
            $this->resource($product_categories, ProductCategoryResource::class),
            ''
        );
    }

    public function find($product_categoryId)
    {
        $product_category = $this->product_categoryService->find($product_categoryId);

        return $this->successResponse(
            $this->resource($product_category, ProductCategoryResource::class),
            ''
        );
    }
    public function getCategoryWithProducts($product_categoryId)
    {
        $product_category = $this->product_categoryService->getCategoryWithProducts($product_categoryId);

        return $this->successResponse(
            $this->resource($product_category, ProductCategoryResource::class),
            ''
        );
    }

    public function create(ProductCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $product_category = $this->product_categoryService->create($validatedData);

        return $this->successResponse(
            $this->resource($product_category, ProductCategoryResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(ProductCategoryRequest $request, $product_categoryId)
    {
        $validatedData = $request->validated();
        $this->product_categoryService->update($validatedData, $product_categoryId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($product_categoryId)
    {
        $this->product_categoryService->delete($product_categoryId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
    public function updateStatus(ProductCategoryRequest $request, $product_categoryId)
    {
        $validatedData = $request->validated();
        $this->product_categoryService->updateStatus($validatedData, $product_categoryId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }
}

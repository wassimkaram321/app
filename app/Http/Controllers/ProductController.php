<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function getAll()
    {
        $products = $this->productService->getAll();
        return $this->successResponse(
            $this->resource($products, ProductResource::class),
            ''
        );
    }

    public function find($productId)
    {
        $product = $this->productService->find($productId);

        return $this->successResponse(
            $this->resource($product, ProductResource::class),
            ''
        );
    }
    public function updateStatus(ProductRequest $request, $productId)
    {
        $validatedData = $request->validated();
        $this->productService->updateStatus($validatedData, $productId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function create(ProductRequest $request)
    {
        $validatedData = $request->validated();
        $product = $this->productService->create($validatedData);

        return $this->successResponse(
            $this->resource($product, ProductResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(ProductRequest $request, $productId)
    {
        $validatedData = $request->validated();
        $this->productService->update($validatedData, $productId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($productId)
    {
        $this->productService->delete($productId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

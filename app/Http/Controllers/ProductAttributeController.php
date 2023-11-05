<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAttributeRequest;
use App\Http\Resources\ProductAttributeResource;
use App\Services\ProductAttributeService;

class ProductAttributeController extends Controller
{
    public function __construct(private ProductAttributeService $product_attributeService)
    {
    }

    public function getAll()
    {
        $product_attributes = $this->product_attributeService->getAll();
        return $this->successResponse(
            $this->resource($product_attributes, ProductAttributeResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function find($product_attributeId)
    {
        $product_attribute = $this->product_attributeService->find($product_attributeId);

        return $this->successResponse(
            $this->resource($product_attribute, ProductAttributeResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function create(ProductAttributeRequest $request)
    {
        $validatedData = $request->validated();
        $product_attribute = $this->product_attributeService->create($validatedData);

        return $this->successResponse(
            $this->resource($product_attribute, ProductAttributeResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(ProductAttributeRequest $request, $product_attributeId)
    {
        $validatedData = $request->validated();
        $this->product_attributeService->update($validatedData, $product_attributeId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($product_attributeId)
    {
        $this->product_attributeService->delete($product_attributeId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

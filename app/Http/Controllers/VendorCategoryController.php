<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorCategoryRequest;
use App\Http\Resources\VendorCategoryResource;
use App\Services\VendorCategoryService;

class VendorCategoryController extends Controller
{
    public function __construct(private VendorCategoryService $vendor_categoryService)
    {
    }

    public function getAll()
    {
        $vendor_categories = $this->vendor_categoryService->getAll();
        return $this->successResponse(
            $this->resource($vendor_categories, VendorCategoryResource::class),
            ''
        );
    }

    public function find($vendor_categoryId)
    {
        $vendor_category = $this->vendor_categoryService->find($vendor_categoryId);

        return $this->successResponse(
            $this->resource($vendor_category, VendorCategoryResource::class),
            ''
        );
    }
    public function getCategoryWithVendors($vendor_categoryId)
    {
        $vendor_category = $this->vendor_categoryService->getCategoryWithVendors($vendor_categoryId);

        return $this->successResponse(
            $this->resource($vendor_category, VendorCategoryResource::class),
            ''
        );
    }

    public function create(VendorCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $vendor_category = $this->vendor_categoryService->create($validatedData);

        return $this->successResponse(
            $this->resource($vendor_category, VendorCategoryResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(VendorCategoryRequest $request, $vendor_categoryId)
    {
        $validatedData = $request->validated();
        $this->vendor_categoryService->update($validatedData, $vendor_categoryId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($vendor_categoryId)
    {
        $this->vendor_categoryService->delete($vendor_categoryId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
    public function updateStatus(VendorCategoryRequest $request, $vendor_categoryId)
    {
        $validatedData = $request->validated();
        $this->vendor_categoryService->updateStatus($validatedData, $vendor_categoryId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }
}

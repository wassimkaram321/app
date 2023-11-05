<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerCategoryRequest;
use App\Http\Resources\BannerCategoryResource;
use App\Services\BannerCategoryService;

class BannerCategoryController extends Controller
{
    public function __construct(private BannerCategoryService $banner_categoryService)
    {
    }

    public function getAll()
    {
        $banner_categories = $this->banner_categoryService->getAll();
        return $this->successResponse(
            $this->resource($banner_categories, BannerCategoryResource::class),
            ''
        );
    }

    public function find($banner_categoryId)
    {
        $banner_category = $this->banner_categoryService->find($banner_categoryId);

        return $this->successResponse(
            $this->resource($banner_category, BannerCategoryResource::class),
            ''
        );
    }
    public function getCategoryWithBanners($banner_categoryId)
    {
        $banner_category = $this->banner_categoryService->getCategoryWithBanners($banner_categoryId);
        return $this->successResponse(
            $this->resource($banner_category, BannerCategoryResource::class),
            ''
        );
    }

    public function create(BannerCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $banner_category = $this->banner_categoryService->create($validatedData);

        return $this->successResponse(
            $this->resource($banner_category, BannerCategoryResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(BannerCategoryRequest $request, $banner_categoryId)
    {
        $validatedData = $request->validated();
        $this->banner_categoryService->update($validatedData, $banner_categoryId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($banner_categoryId)
    {
        $this->banner_categoryService->delete($banner_categoryId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
    public function updateStatus(BannerCategoryRequest $request, $banner_categoryId)
    {
        $validatedData = $request->validated();
        $this->banner_categoryService->updateStatus($validatedData, $banner_categoryId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }
}

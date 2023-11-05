<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\BannerCategory;

class BannerCategoryService
{
    use ModelHelper;
    public function __construct(private BannerCategory $bannerCategory)
    {
    }
    public function getAll()
    {
        if(request()->has('page'))
            return $this->bannerCategory->filter()->paginate(request()->items_per_page);
        return $this->bannerCategory->filter()->get();
    }

    public function find($banner_categoryId)
    {
        return $this->findByIdOrFail(BannerCategory::class,'banner_category', $banner_categoryId);
    }
    public function getCategoryWithBanners($banner_categoryId)
    {
        return $this->find($banner_categoryId)->with('banners')->first();
    }
    public function create($validatedData)
    {
        DB::beginTransaction();

        $banner_category =$this->bannerCategory->create($validatedData);

        DB::commit();

        return $banner_category;
    }

    public function update($validatedData, $banner_categoryId)
    {
        $banner_category = $this->find($banner_categoryId);

        DB::beginTransaction();

        $banner_category->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($banner_categoryId)
    {
        $banner_category = $this->find($banner_categoryId);

        DB::beginTransaction();

        $banner_category->delete();

        DB::commit();

        return true;
    }
    public function updateStatus($validatedData, $banner_categoryId)
    {
        $banner_category = $this->find($banner_categoryId);

        DB::beginTransaction();

        $banner_category->update($validatedData);

        DB::commit();

        return true;
    }
}

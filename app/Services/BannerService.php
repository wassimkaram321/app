<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Traits\UploadImageTrait;
use App\Models\Banner;

class BannerService
{
    use ModelHelper , UploadImageTrait;
    public function __construct(private Banner $banner)
    {
    }
    public function getAll()
    {
        if(request()->has('page'))
            return $this->banner->paginate(request()->items_per_page);
        return $this->banner->with(['bannerCategory','vendor'])->get();
    }

    public function find($bannerId)
    {
        return $this->findByIdOrFail(Banner::class,'banner', $bannerId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();


        $banner = $this->banner->create($validatedData);
        if(request()->has('image'))
            $this->uploadImage($banner,$validatedData['image'],'banners');
        if(request()->has('images'))
            $this->uploadImages($banner,$validatedData['images'],'banner-images');

        DB::commit();

        return $banner;
    }

    public function update($validatedData, $bannerId)
    {
        $banner = $this->find($bannerId);

        DB::beginTransaction();

        $banner->update($validatedData);

        $banner = $this->banner->create($validatedData);
        if(request()->has('image'))
            $this->uploadImage($banner,request()->image,'banners');
        if(request()->has('images'))
            $this->uploadImages($banner,request()->images,'banner-images');

        DB::commit();

        return true;
    }

    public function delete($bannerId)
    {
        $banner = $this->find($bannerId);

        DB::beginTransaction();

        $banner->delete();

        DB::commit();

        return true;
    }
    public function updateStatus($validatedData, $bannerId)
    {
        $banner = $this->find($bannerId);

        DB::beginTransaction();

        $banner->update($validatedData);

        DB::commit();

        return true;
    }
}

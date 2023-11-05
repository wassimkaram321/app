<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Traits\UploadImageTrait;
use App\Models\Vendor;

class VendorService
{
    use ModelHelper , UploadImageTrait;
    public function __construct(private Vendor $vendor)
    {
    }
    public function getAll()
    {
        if(request()->has('page'))
            return $this->vendor->paginate(request()->items_per_page);
        return $this->vendor->filter()->get();
    }

    public function find($vendorId)
    {
        return $this->findByIdOrFail(Vendor::class,'vendor', $vendorId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $validatedData['slug'] = \Str::slug($validatedData['name']);

        $vendor = $this->vendor->create($validatedData);

        if(request()->has('image'))
            $this->uploadImage($vendor,request()->image,'vendors');
        if(request()->has('images'))
            $this->uploadImages($vendor,request()->images,'vendor-images');

        DB::commit();

        return $vendor;
    }

    public function update($validatedData, $vendorId)
    {
        $vendor = $this->find($vendorId);

        DB::beginTransaction();

        $validatedData['slug'] = \Str::slug($validatedData['name']);

        $vendor->update($validatedData);

        if(request()->has('image'))
            $this->uploadImage($vendor,request()->image,'vendors');
        if(request()->has('images'))
            $this->uploadImages($vendor,request()->images,'vendor-images');

        DB::commit();

        return true;
    }
    public function updateStatus($validatedData, $vendorId)
    {
        $vendor = $this->find($vendorId);

        DB::beginTransaction();

        $vendor->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($vendorId)
    {
        $vendor = $this->find($vendorId);

        DB::beginTransaction();

        $vendor->delete();

        DB::commit();

        return true;
    }
}

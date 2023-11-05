<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\VendorCategory;

class VendorCategoryService
{
    use ModelHelper;
    public function __construct(private VendorCategory $vendorCategory)
    {
    }
    public function getAll()
    {
        if(request()->has('page'))
            return $this->vendorCategory->paginate(request()->items_per_page);
        return $this->vendorCategory->all();
    }

    public function find($vendor_categoryId)
    {
        return $this->findByIdOrFail(VendorCategory::class,'vendor_category', $vendor_categoryId);
    }
    public function getCategoryWithVendors($vendor_categoryId)
    {
        return $this->find($vendor_categoryId)->with('vendors')->first();
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $vendor_category = $this->vendorCategory->create($validatedData);

        DB::commit();

        return $vendor_category;
    }

    public function update($validatedData, $vendor_categoryId)
    {
        $vendor_category = $this->find($vendor_categoryId);

        DB::beginTransaction();

        $vendor_category->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($vendor_categoryId)
    {
        $vendor_category = $this->find($vendor_categoryId);

        DB::beginTransaction();

        $vendor_category->delete();

        DB::commit();

        return true;
    }
    public function updateStatus($validatedData, $vendor_categoryId)
    {
        $vendor_category = $this->find($vendor_categoryId);

        DB::beginTransaction();

        $vendor_category->update($validatedData);

        DB::commit();

        return true;
    }
}

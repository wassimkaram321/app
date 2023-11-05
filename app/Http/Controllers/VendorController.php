<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Http\Resources\VendorResource;
use App\Services\VendorService;

class VendorController extends Controller
{
    public function __construct(private VendorService $vendorService)
    {
    }

    public function getAll()
    {
        $vendors = $this->vendorService->getAll();
        return $this->successResponse(
            $this->resource($vendors, VendorResource::class),
            ''
        );
    }

    public function find($vendorId)
    {
        $vendor = $this->vendorService->find($vendorId);

        return $this->successResponse(
            $this->resource($vendor, VendorResource::class),
            ''
        );
    }

    public function create(VendorRequest $request)
    {
        $validatedData = $request->validated();
        $vendor = $this->vendorService->create($validatedData);

        return $this->successResponse(
            $this->resource($vendor, VendorResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(VendorRequest $request, $vendorId)
    {
        $validatedData = $request->validated();
        $this->vendorService->update($validatedData, $vendorId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($vendorId)
    {
        $this->vendorService->delete($vendorId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
    public function updateStatus(VendorRequest $request, $vendorId)
    {
        $validatedData = $request->validated();
        $this->vendorService->updateStatus($validatedData, $vendorId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }
}

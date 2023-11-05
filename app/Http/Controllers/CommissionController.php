<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommissionRequest;
use App\Http\Resources\CommissionResource;
use App\Services\CommissionService;

class CommissionController extends Controller
{
    public function __construct(private CommissionService $commissionService)
    {
    }

    public function getAll()
    {
        $commissions = $this->commissionService->getAll();
        return $this->successResponse(
            $this->resource($commissions, CommissionResource::class),
            ''
        );
    }

    public function find($commissionId)
    {
        $commission = $this->commissionService->find($commissionId);

        return $this->successResponse(
            $this->resource($commission, CommissionResource::class),
            ''
        );
    }

    public function create(CommissionRequest $request)
    {
        $validatedData = $request->validated();
        $commission = $this->commissionService->create($validatedData);

        return $this->successResponse(
            $this->resource($commission, CommissionResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(CommissionRequest $request, $commissionId)
    {
        $validatedData = $request->validated();
        $this->commissionService->update($validatedData, $commissionId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($commissionId)
    {
        $this->commissionService->delete($commissionId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

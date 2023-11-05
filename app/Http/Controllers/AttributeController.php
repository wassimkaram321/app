<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Services\AttributeService;

class AttributeController extends Controller
{
    public function __construct(private AttributeService $attributeService)
    {
    }

    public function getAll()
    {
        $attributes = $this->attributeService->getAll();
        return $this->successResponse(
            $this->resource($attributes, AttributeResource::class),
            ''
        );
    }

    public function find($attributeId)
    {
        $attribute = $this->attributeService->find($attributeId);

        return $this->successResponse(
            $this->resource($attribute, AttributeResource::class),
            ''
        );
    }

    public function create(AttributeRequest $request)
    {
        $validatedData = $request->validated();
        $attribute = $this->attributeService->create($validatedData);

        return $this->successResponse(
            $this->resource($attribute, AttributeResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(AttributeRequest $request, $attributeId)
    {
        $validatedData = $request->validated();
        $this->attributeService->update($validatedData, $attributeId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($attributeId)
    {
        $this->attributeService->delete($attributeId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

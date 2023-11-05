<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeValueRequest;
use App\Http\Resources\AttributeValueResource;
use App\Services\AttributeValueService;

class AttributeValueController extends Controller
{
    public function __construct(private AttributeValueService $attribute_valueService)
    {
    }

    public function getAll()
    {
        $attribute_values = $this->attribute_valueService->getAll();
        return $this->successResponse(
            $this->resource($attribute_values, AttributeValueResource::class),
            ''
        );
    }

    public function find($attribute_valueId)
    {
        $attribute_value = $this->attribute_valueService->find($attribute_valueId);

        return $this->successResponse(
            $this->resource($attribute_value, AttributeValueResource::class),
            ''
        );
    }

    public function create(AttributeValueRequest $request)
    {
        $validatedData = $request->validated();
        $attribute_value = $this->attribute_valueService->create($validatedData);

        return $this->successResponse(
            $this->resource($attribute_value, AttributeValueResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(AttributeValueRequest $request, $attribute_valueId)
    {
        $validatedData = $request->validated();
        $this->attribute_valueService->update($validatedData, $attribute_valueId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($attribute_valueId)
    {
        $this->attribute_valueService->delete($attribute_valueId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

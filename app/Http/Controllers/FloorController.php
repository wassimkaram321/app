<?php

namespace App\Http\Controllers;

use App\Http\Requests\FloorRequest;
use App\Http\Resources\FloorResource;
use App\Services\FloorService;

class FloorController extends Controller
{
    public function __construct(private FloorService $floorService)
    {
    }

    public function getAll()
    {
        $floors = $this->floorService->getAll();
        return $this->successResponse(
            $this->resource($floors, FloorResource::class),
            ''
        );
    }

    public function find($floorId)
    {
        $floor = $this->floorService->find($floorId);

        return $this->successResponse(
            $this->resource($floor, FloorResource::class),
            ''
        );
    }
    public function getFloorWithSpaces($floorId)
    {
        $floor = $this->floorService->getFloorWithSpaces($floorId);

        return $this->successResponse(
            $this->resource($floor, FloorResource::class),
            ''
        );
    }

    public function create(FloorRequest $request)
    {
        $validatedData = $request->validated();
        $floor = $this->floorService->create($validatedData);

        return $this->successResponse(
            $this->resource($floor, FloorResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(FloorRequest $request, $floorId)
    {
        $validatedData = $request->validated();
        $this->floorService->update($validatedData, $floorId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($floorId)
    {
        $this->floorService->delete($floorId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

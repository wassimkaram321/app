<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpaceRequest;
use App\Http\Resources\SpaceResource;
use App\Services\SpaceService;

class SpaceController extends Controller
{
    public function __construct(private SpaceService $spaceService)
    {
    }

    public function getAll()
    {
        $spaces = $this->spaceService->getAll();
        return $this->successResponse(
            $this->resource($spaces, SpaceResource::class),
            ''
        );
    }

    public function find($spaceId)
    {
        $space = $this->spaceService->find($spaceId);

        return $this->successResponse(
            $this->resource($space, SpaceResource::class),
            ''
        );
    }

    public function create(SpaceRequest $request)
    {
        $validatedData = $request->validated();
        $space = $this->spaceService->create($validatedData);

        return $this->successResponse(
            $this->resource($space, SpaceResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(SpaceRequest $request, $spaceId)
    {
        $validatedData = $request->validated();
        $this->spaceService->update($validatedData, $spaceId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($spaceId)
    {
        $this->spaceService->delete($spaceId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

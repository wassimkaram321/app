<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Http\Resources\Mediaesource;
use App\Services\MediaService;

class MediaController extends Controller
{
    public function __construct(private MediaService $mediaService)
    {
    }

    public function getAll()
    {
        $media = $this->mediaService->getAll();
        return $this->successResponse(
            $this->resource($media, Mediaesource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function find($mediumId)
    {
        $medium = $this->mediaService->find($mediumId);

        return $this->successResponse(
            $this->resource($medium, Mediaesource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function create(MediaRequest $request)
    {
        $validatedData = $request->validated();
        $medium = $this->mediaService->create($validatedData);

        return $this->successResponse(
            $this->resource($medium, MediaResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(MediaRequest $request, $mediumId)
    {
        $validatedData = $request->validated();
        $this->mediaService->update($validatedData, $mediumId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($mediumId)
    {
        $this->mediaService->delete($mediumId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

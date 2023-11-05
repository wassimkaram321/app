<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Http\Resources\SectionResource;
use App\Services\SectionService;

class SectionController extends Controller
{
    public function __construct(private SectionService $sectionService)
    {
    }

    public function getAll()
    {
        $sections = $this->sectionService->getAll();
        return $this->successResponse(
            $this->resource($sections, SectionResource::class),
            ''
        );
    }

    public function find($sectionId)
    {
        $section = $this->sectionService->find($sectionId);

        return $this->successResponse(
            $this->resource($section, SectionResource::class),
            ''
        );
    }

    public function create(SectionRequest $request)
    {
        $validatedData = $request->validated();
        $section = $this->sectionService->create($validatedData);

        return $this->successResponse(
            $this->resource($section, SectionResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(SectionRequest $request, $sectionId)
    {
        $validatedData = $request->validated();
        $this->sectionService->update($validatedData, $sectionId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($sectionId)
    {
        $this->sectionService->delete($sectionId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

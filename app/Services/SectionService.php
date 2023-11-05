<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Section;

class SectionService
{
    use ModelHelper;
    public function __construct(private Section $section)
    {
    }
    public function getAll()
    {
        return $this->section->all();
    }

    public function find($sectionId)
    {
        return $this->findByIdOrFail(Section::class,'section', $sectionId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $section = $this->section->create($validatedData);

        DB::commit();

        return $section;
    }

    public function update($validatedData, $sectionId)
    {
        $section = $this->find($sectionId);

        DB::beginTransaction();

        $section->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($sectionId)
    {
        $section = $this->find($sectionId);

        DB::beginTransaction();

        $section->delete();

        DB::commit();

        return true;
    }
}

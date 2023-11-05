<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Space;

class SpaceService
{
    use ModelHelper;
    public function __construct(private Space $space)
    {
    }
    public function getAll()
    {
        return $this->space->all();
    }

    public function find($spaceId)
    {
        return $this->findByIdOrFail(Space::class,'space', $spaceId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $space = $this->space->create($validatedData);

        DB::commit();

        return $space;
    }

    public function update($validatedData, $spaceId)
    {
        $space = $this->find($spaceId);

        DB::beginTransaction();

        $space->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($spaceId)
    {
        $space = $this->find($spaceId);

        DB::beginTransaction();

        $space->delete();

        DB::commit();

        return true;
    }
}

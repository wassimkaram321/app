<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Floor;

class FloorService
{
    use ModelHelper;
    public function __construct(private Floor $floor)
    {
    }
    public function getAll()
    {
        return $this->floor->all();
    }

    public function find($floorId)
    {
        return $this->findByIdOrFail(Floor::class,'floor', $floorId);
    }
    public function getFloorWithSpaces($floorId)
    {
        return $this->find($floorId)->with('spaces')->first();
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $floor =  $this->floor->create($validatedData);

        DB::commit();

        return $floor;
    }

    public function update($validatedData, $floorId)
    {
        $floor = $this->find($floorId);

        DB::beginTransaction();

        $floor->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($floorId)
    {
        $floor = $this->find($floorId);

        DB::beginTransaction();

        $floor->delete();

        DB::commit();

        return true;
    }
}

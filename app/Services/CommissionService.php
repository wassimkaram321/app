<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Commission;

class CommissionService
{
    use ModelHelper;
    public function __construct(private Commission $commission)
    {
    }
    public function getAll()
    {
        if(request()->has('page'))
            return $this->commission->paginate(request()->items_per_page);
        return $this->commission->all();
    }

    public function find($commissionId)
    {
        return $this->findByIdOrFail(Commission::class,'commission', $commissionId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $commission = $this->commission->create($validatedData);

        DB::commit();

        return $commission;
    }

    public function update($validatedData, $commissionId)
    {
        $commission = $this->find($commissionId);

        DB::beginTransaction();

        $commission->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($commissionId)
    {
        $commission = $this->find($commissionId);

        DB::beginTransaction();

        $commission->delete();

        DB::commit();

        return true;
    }
}

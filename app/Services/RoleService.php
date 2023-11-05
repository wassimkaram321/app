<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Attribute;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function __construct(private Role $role)
    {
    }
    use ModelHelper;

    public function getAll()
    {
        if(request()->has('page'))
            return $this->role->paginate(request()->items_per_page);
        return $this->role->all();
    }

    public function find($roleId)
    {
        return $this->findByIdOrFail(Role::class,'role', $roleId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $attribute = $this->role->create($validatedData);

        DB::commit();

        return $attribute;
    }

    public function update($validatedData, $roleId)
    {
        $role = $this->find($roleId);

        DB::beginTransaction();

        $role->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($roleId)
    {
        $role = $this->find($roleId);

        DB::beginTransaction();

        $role->delete();

        DB::commit();

        return true;
    }
}

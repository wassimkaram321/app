<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\User;

class UserService
{
    use ModelHelper;
    public function __construct(private User $user)
    {
    }
    public function getAll()
    {
        return $this->user->all();
    }

    public function find($userId)
    {
        return $this->findByIdOrFail(User::class,'user', $userId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $user = $this->user->create($validatedData);

        $user->wallet()->create();

        DB::commit();

        return $user;
    }

    public function update($validatedData, $userId)
    {
        $user = $this->find($userId);

        DB::beginTransaction();

        $user->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($userId)
    {
        $user = $this->find($userId);

        DB::beginTransaction();

        $user->delete();

        $user->wallet()->delete();

        DB::commit();

        return true;
    }
}

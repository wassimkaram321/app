<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Wallet;

class WalletService
{
    use ModelHelper;
    public function __construct(private Wallet $wallet)
    {
    }
    public function getAll()
    {
        return $this->wallet->all();
    }

    public function find($walletId)
    {
        return $this->findByIdOrFail(Wallet::class,'wallet', $walletId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $wallet = $this->wallet->create($validatedData);

        DB::commit();

        return $wallet;
    }

    public function update($validatedData, $walletId)
    {
        $wallet = $this->find($walletId);

        DB::beginTransaction();

        $wallet->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($walletId)
    {
        $wallet = $this->find($walletId);

        DB::beginTransaction();

        $wallet->delete();

        DB::commit();

        return true;
    }
}

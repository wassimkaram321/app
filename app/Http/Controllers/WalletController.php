<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Http\Resources\WalletResource;
use App\Services\WalletService;

class WalletController extends Controller
{
    public function __construct(private WalletService $walletService)
    {
    }

    public function getAll()
    {
        $wallets = $this->walletService->getAll();
        return $this->successResponse(
            $this->resource($wallets, WalletResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function find($walletId)
    {
        $wallet = $this->walletService->find($walletId);

        return $this->successResponse(
            $this->resource($wallet, WalletResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function create(WalletRequest $request)
    {
        $validatedData = $request->validated();
        $wallet = $this->walletService->create($validatedData);

        return $this->successResponse(
            $this->resource($wallet, WalletResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(WalletRequest $request, $walletId)
    {
        $validatedData = $request->validated();
        $this->walletService->update($validatedData, $walletId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($walletId)
    {
        $this->walletService->delete($walletId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

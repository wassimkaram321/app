<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Services\CartService;

class CartController extends Controller
{
    public function __construct(private CartService $cartService )
    {
    }

    public function getAll()
    {
        $carts = $this->cartService->getAll();
        return $this->successResponse(
            $this->resource($carts, CartResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function find($cartId)
    {
        $cart = $this->cartService->find($cartId);

        return $this->successResponse(
            $this->resource($cart, CartResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function create(CartRequest $request)
    {
        $validatedData = $request->validated();
        $cart = $this->cartService->createCart($validatedData);

        return $this->successResponse(
            $this->resource($cart, CartResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(CartRequest $request, $cartId)
    {
        $validatedData = $request->validated();
        $this->cartService->update($validatedData, $cartId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($cartId)
    {
        $this->cartService->delete($cartId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

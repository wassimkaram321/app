<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Services\CartItemService;

class CartItemController extends Controller
{
    public function __construct(private CartItemService $cart_itemService)
    {
    }

    public function getAll()
    {
        $cart_items = $this->cart_itemService->getAll();
        return $this->successResponse(
            $this->resource($cart_items, CartItemResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function find($cart_itemId)
    {
        $cart_item = $this->cart_itemService->find($cart_itemId);

        return $this->successResponse(
            $this->resource($cart_item, CartItemResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function create(CartItemRequest $request)
    {
        $validatedData = $request->validated();
        $cart_item = $this->cart_itemService->create($validatedData);

        return $this->successResponse(
            $this->resource($cart_item, CartItemResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(CartItemRequest $request, $cart_itemId)
    {
        $validatedData = $request->validated();
        $this->cart_itemService->update($validatedData, $cart_itemId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($cart_itemId)
    {
        $this->cart_itemService->delete($cart_itemId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}

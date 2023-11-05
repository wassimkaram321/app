<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\CartItem;

class CartItemService
{
    use ModelHelper;

    public function getAll()
    {
        return CartItem::all();
    }

    public function find($cart_itemId)
    {
        return $this->findByIdOrFail(CartItem::class,'cart_item', $cart_itemId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $cart_item = CartItem::create($validatedData);

        DB::commit();

        return $cart_item;
    }

    public function update($validatedData, $cart_itemId)
    {
        $cart_item = $this->find($cart_itemId);

        DB::beginTransaction();

        $cart_item->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($cart_itemId)
    {
        $cart_item = $this->find($cart_itemId);

        DB::beginTransaction();

        $cart_item->delete();

        DB::commit();

        return true;
    }
}

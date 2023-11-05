<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartService
{
    use ModelHelper;

    public function __construct(private CartItemService $cartItem)
    {
    }
    public function getAll()
    {
        return Cart::all();
    }

    public function find($cartId)
    {
        return $this->find($cartId)->with('items')->first();
    }
    public function findCart($cartId)
    {
        return $this->findByIdOrFail(Cart::class,'cart', $cartId);
    }
    public function create($validatedData)
    {
        DB::beginTransaction();

        $cart = Cart::create($validatedData);

        DB::commit();

        return $cart;
    }
    public function createCart($validatedData)
    {
        DB::beginTransaction();

        // $user = Auth::user();
        $user = User::first();
        $validatedData['user_id'] = $user->id;

        $cart = $this->getOrCreateCart($user, $validatedData);
        $this->addItemsToCart($cart, $validatedData['items']);

        DB::commit();

        return $cart;
    }



    public function update($validatedData, $cartId)
    {
        $cart = $this->cartItem->find($cartId);

        DB::beginTransaction();

        $cart->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($cartId)
    {
        $cart = $this->cartItem->find($cartId);

        DB::beginTransaction();

        $cart->delete();

        DB::commit();

        return true;
    }
    private function getOrCreateCart($user, $validatedData)
    {
        return $user->cart ?? $this->create($validatedData);
    }
    private function addItemsToCart($cart, $items)
    {
        foreach ($items as $item) {
            $cart->items()->updateOrCreate(
                ['product_id' => $item['product_id']],
                ['quantity' => $item['quantity']]
            );
        }
    }
}

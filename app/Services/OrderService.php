<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Order;

class OrderService
{
    use ModelHelper;
    public function __construct(private CartService $cartService)
    {
    }
    public function getAll()
    {
        return Order::all();
    }

    public function find($orderId)
    {
        return $this->findByIdOrFail(Order::class, 'order', $orderId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $orderDetailsData = [];
        $cart = $this->cartService->findCart($validatedData['cart_id']);
        $validatedData['user_id'] = $cart->user_id;

        $totalAmount = $cart->load('items')->items->load('product')->map(function ($item) use (&$orderDetailsData) {
            $orderDetailsData[] = [
                'product_id' => $item->product->id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
                'status'     => "Pending",
            ];
            return $item->quantity * $item->product->price;
        })->sum();

        $validatedData['total_amount'] = $totalAmount;
        $validatedData['status'] = "Pending";

        $order = Order::create($validatedData);


        $order->orderDetails()->createMany($orderDetailsData);

        $this->cartService->delete($cart->id);

        DB::commit();

        return $order;
    }


    public function update($validatedData, $orderId)
    {
        $order = $this->find($orderId);

        DB::beginTransaction();

        $order->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($orderId)
    {
        $order = $this->find($orderId);

        DB::beginTransaction();

        $order->delete();

        DB::commit();

        return true;
    }
}

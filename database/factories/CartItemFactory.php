<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cart_id' => '',
            'product_id' => '',
            'quantity' => '',
            'cart_id' => '',
            'product_id' => ''
        ];
    }
}

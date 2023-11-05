<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attribute_id' => '',
            'product_id' => '',
            'selected_value' => '',
            'quantity' => '',
            'attribute_id' => '',
            'product_id' => ''
        ];
    }
}

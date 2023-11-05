<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => '',
            'description' => '',
            'internal_reference' => '',
            'measurement_unit_id' => '',
            'product_category_id' => '',
            'product_category_id' => '',
            'measurement_unit_id' => ''
        ];
    }
}

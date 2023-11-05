<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveredProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => '',
            'type' => '',
            'product_id' => '',
            'work_plan_visit_id' => '',
            'product_id' => '',
            'work_plan_visit_id' => ''
        ];
    }
}

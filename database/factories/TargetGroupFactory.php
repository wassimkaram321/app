<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TargetGroupFactory extends Factory
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
            'address' => '',
            'lat' => '',
            'lng' => '',
            'is_in_service' => '',
            'is_new' => '',
            'fixed_phone' => '',
            'phone_number' => '',
            'opening_time' => '',
            'closing_time' => '',
            'city_id' => '',
            'target_type_id' => '',
            'specialization_id' => ''
        ];
    }
}

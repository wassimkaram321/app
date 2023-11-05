<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
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
            'slug' => '',
            'latitude' => '',
            'longitude' => '',
            'address' => '',
            'phone' => '',
            'email' => '',
            'is_active' => '',
            'vendor_category_id' => '',
            'city_id' => '',
            'vendor_category_id' => '',
            'city_id' => ''
        ];
    }
}

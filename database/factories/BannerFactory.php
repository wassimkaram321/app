<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => '',
            'end_date' => '',
            'is_active' => '',
            'banner_category_id' => '',
            'vendor_id' => '',
            'banner_category_id' => '',
            'vendor_id' => ''
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
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
            'space' => '',
            'position' => '',
            'space_id' => '',
            'vendor_category_id' => '',
            'is_active' => '',
            'space_id' => '',
            'vendor_category_id' => ''
        ];
    }
}

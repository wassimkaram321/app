<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceFactory extends Factory
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
            'is_active' => '',
            'floor_id' => '',
            'floor_id' => ''
        ];
    }
}

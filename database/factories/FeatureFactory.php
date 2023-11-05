<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => '',
            'content' => '',
            'is_active' => '',
            'featureable_id' => '',
            'featureable_type' => ''
        ];
    }
}

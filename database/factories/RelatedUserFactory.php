<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RelatedUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => '',
            'related_id' => '',
            'user_id' => '',
            'related_id' => ''
        ];
    }
}

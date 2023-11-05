<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PasswordResetTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => '',
            'token' => '',
            'created_at' => ''
        ];
    }
}

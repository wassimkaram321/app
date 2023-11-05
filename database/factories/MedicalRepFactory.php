<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'password' => '',
            'address' => '',
            'phone' => '',
            'email_verified_at' => '',
            'last_login_at' => '',
            'gender' => '',
            'status' => '',
            'position' => '',
            'fcm_token' => '',
            'city_id' => '',
            'city_id' => ''
        ];
    }
}

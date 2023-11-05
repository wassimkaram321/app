<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExternalVisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'city_id' => '',
            'target_group_id' => '',
            'report_type_id' => '',
            'medical_rep_id' => '',
            'city_id' => '',
            'target_group_id' => '',
            'report_type_id' => '',
            'medical_rep_id' => ''
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecializationClassificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'specialization_id'   => '',
            'classification_id'   => '',
            'compare_type'        => '',
            'number_of_patients'  => '',
            'specialization_id'   => '',
            'classification_id'   => ''
        ];
    }
}

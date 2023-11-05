<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note' => '',
            'start_date' => '',
            'end_date' => '',
            'is_in_service' => '',
            'days_duration' => '',
            'medical_rep_id' => '',
            'medical_rep_id' => ''
        ];
    }
}

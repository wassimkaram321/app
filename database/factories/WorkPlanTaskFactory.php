<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkPlanTaskFactory extends Factory
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
            'priority_level' => '',
            'time' => '',
            'date' => '',
            'status' => '',
            'work_plan_id' => '',
            'target_group_id' => '',
            'work_plan_id' => '',
            'target_group_id' => ''
        ];
    }
}

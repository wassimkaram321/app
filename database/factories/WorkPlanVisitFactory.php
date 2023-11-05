<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkPlanVisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'details' => '',
            'lat' => '',
            'lng' => '',
            'is_site_match' => '',
            'work_plan_id' => '',
            'report_type_id' => '',
            'work_plan_task_id' => '',
            'work_plan_id' => '',
            'report_type_id' => '',
            'work_plan_task_id' => ''
        ];
    }
}

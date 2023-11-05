<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MediumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'model' => '',
            'uuid' => '',
            'collection_name' => '',
            'name' => '',
            'file_name' => '',
            'mime_type' => '',
            'disk' => '',
            'conversions_disk' => '',
            'size' => '',
            'manipulations' => '',
            'custom_properties' => '',
            'generated_conversions' => '',
            'responsive_images' => '',
            'order_column' => ''
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_ar' => fake()->name(),
            'name_en' => fake()->name(),
            'description_ar' => fake()->text(),
            'description_en' => fake()->text(),
            'master_photo' => 'default.png',
            'price' => fake()->randomNumber(),
            'category_id' => rand(1,5),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
}

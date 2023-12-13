<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calorie>
 */
class CalorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'carbohydrate' => fake()->randomFloat(1, 0, 100),
            'protain' => fake()->randomFloat(1, 0, 100),
            'fat' => fake()->randomFloat(1, 0, 100),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(10) . ' Product',
            'description' => fake()->paragraph,
            'price' => fake()->numberBetween(100, 1000),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}

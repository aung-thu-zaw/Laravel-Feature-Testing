<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
        "name" => fake()->unique()->name(),
        "image" => fake()->imageUrl(),
        "code" => fake()->randomLetter(),
        "qty" => fake()->numberBetween(1111, 9999),
        "price" => fake()->numberBetween(50, 1000)
        ];
    }
}

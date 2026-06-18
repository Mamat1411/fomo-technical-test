<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            "name" => fake()->sentence(3),
            "description" => fake()->paragraph(mt_rand(2, 4), false),
            "base_price" => fake()->randomNumber(mt_rand(4, 7), true)
        ];
    }
}

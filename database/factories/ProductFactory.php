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
            'name' => $this->faker->unique()->word(3, true),
            'description' => $this->faker->sentence(),
            'sale_price' => $this->faker->randomNumber(3, true),
            'purchase_price' => $this->faker->randomNumber(4, true),
            'stock' => $this->faker->randomNumber(3, true),
            'minimum_stock' => $this->faker->randomNumber(2, true),
            'barcode' => $this->faker->ean13(),
            'date_expired' => $this->faker->date('Y-m-d'),
            'category_id' => $this->faker->numberBetween(1, \App\Models\Category::count()),
        ];
    }
}

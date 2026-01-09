<?php

namespace Database\Factories;

use App\Models\Category;
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
        $title = $this->faker->text(50);
        return [
            'category_id' => $this->faker->randomElement(Category::pluck('id')),
            'title' => $title,
            'slug' => str($title)->slug(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 100, 10000),
            'saleprice' => $this->faker->randomFloat(2, 100, 10000),
            'discount' => rand(0, 100),
        ];
    }
}

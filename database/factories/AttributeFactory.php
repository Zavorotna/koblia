<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['text', 'select']; 
        $title = $this->faker->unique()->word();
        return [
            'name' => $this->faker->word,
            'slug' => str($title)->slug(),
            'type' => $this->faker->randomElement($types),
            'is_filterable' => $this->faker->boolean(80),
        ];
    }
}

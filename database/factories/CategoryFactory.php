<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_name = fake()->name;
        return [
            'category_name' => $category_name,
            'slug' => Str::slug($category_name),
            'description' => fake()->paragraph(1),
            'is_active' => fake()->randomElement([0, 1]),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::random(5),
            'description' => fake()->paragraph(),
            'type' => fake()->randomElement(['online', 'offline']),
            'price' => fake()->numberBetween(50000, 500000),
        ];
    }
}

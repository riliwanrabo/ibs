<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->word(),
            'isbn' => fake()->unique()->ean13(),
            'number_of_pages' => fake()->randomNumber(3),
            'country' => fake()->country(),
            'release_date' => fake()->date(),
            'publisher' => fake()->word(),
        ];
    }
}

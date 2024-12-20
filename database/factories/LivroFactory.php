<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Titulo' => fake()->word(),
            'Editora' => fake()->word(),
            'AnoPublicacao' => fake()->year(),
            'Valor' => fake()->randomFloat(2, 0, 500),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class UserApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(15, 35),
            'id_applications' => 1,
        ];
    }
}

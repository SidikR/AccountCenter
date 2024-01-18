<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_details>
 */
class UserDetailsFactory extends Factory
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
            'nama_lengkap' => fake()->name(mt_rand(5, 20)),
            'no_hp' => '12211',
            'nip' => '12345',
            'foto_user' => null
        ];
    }
}

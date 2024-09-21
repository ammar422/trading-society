<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => bcrypt('123465789'),
            'position' => $this->faker->randomElement(['CEO', 'CTO', 'COO', 'consultant', 'expert']),
            'description' => $this->faker->paragraph(),
            'photo' => $this->faker->image()
        ];
    }
}

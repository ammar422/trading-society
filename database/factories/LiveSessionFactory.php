<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LiveSession>
 */
class LiveSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'duration' => $this->faker->numberBetween(30, 120),
            'image' => $this->faker->imageUrl(),
            'video' => $this->faker->url(),
            'instructor_id' => \App\Models\Instructor::inRandomOrder()->first()->id,
        ];
    }
}

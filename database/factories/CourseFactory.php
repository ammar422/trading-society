<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'course title',
            'description' => $this->faker->paragraph(),
            'total_hours' => $this->faker->randomElement([4, 5, 6, 7, 8, 9, 10]),
            'instructor_id' => Instructor::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'photo' => $this->faker->image()
        ];
    }
}

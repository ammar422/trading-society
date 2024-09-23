<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseVedio>
 */
class CourseVedioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::inRandomOrder()->first()->id,
            'video_url' => $this->faker->url,
            'duration' => $this->faker->numberBetween(10, 50), // Random time between 1 and 300 (e.g., seconds)  
            'description' => $this->faker->text(200), // Random text for description  
            'image' => $this->faker->imageUrl(), // Random image URL  
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseVedio>
 */
class CourseVedioFactory extends Factory
{
    // Static variable to maintain the order state  
    private static $order = 0;

    public function definition(): array
    {
        // Increment the order and cycle between 1 and 6  
        self::$order = (self::$order % 6) + 1;

        return [
            'course_id' => Course::inRandomOrder()->first()->id,
            'vedio_url' => $this->faker->url,
            'duration' => $this->faker->numberBetween(10, 50),
            'description' => $this->faker->text(200),
            'image' => $this->faker->imageUrl(),
            'order' => self::$order,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseVedio>
 */
class CourseVedioFactory extends Factory
{
    protected static $order;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        self::$order = (self::$order % 6) + 1;
        return [
            'course_id' => Course::inRandomOrder()->first()->id,
            'vedio_url' => $this->faker->url,
            'duration' => $this->faker->numberBetween(10, 50),
            'description' => $this->faker->text(200),
            'image' => $this->faker->imageUrl(),
            'order' => self::$order
        ];
    }
}

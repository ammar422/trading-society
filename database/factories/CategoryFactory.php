<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'name' => $this->faker->randomElement(['beginner', 'basic', 'chart_patterns', 'advanced', 'expert']),
            'order' => self::$order
        ];
    }
}

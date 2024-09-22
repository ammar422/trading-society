<?php

namespace Database\Factories;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => Instructor::inRandomOrder()->first()->id,
            'order_status' => $this->faker->randomElement(['HIT TP3', 'HIT TP4', 'HIT TP5']),
            'pair' => 'XAU-USD',
            'price' => $this->faker->randomFloat(2, 1, 100),
            'order_type' => $this->faker->randomElement(['BUY LIMIT', 'SEll LIMIT']),
            'sl' => $this->faker->randomFloat(2, 1, 100),
            'tp1' => $this->faker->randomFloat(2, 1, 100),
            'tp2' => $this->faker->randomFloat(2, 1, 100),
            'tp3' => $this->faker->randomFloat(2, 1, 100),
            'tp4' => $this->faker->randomFloat(2, 1, 100),
            'tp5' => $this->faker->randomFloat(2, 1, 100),
            'chart' => $this->faker->url, // Assuming it's a URL  
            'description' => $this->faker->text,
        ];
    }
}

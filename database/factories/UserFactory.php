<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'), // or Hash::make('password') for hashing  
            'phone_number' => $this->faker->phoneNumber,
            'broker' => $this->faker->company,
            'broker_registration_email' => $this->faker->unique()->safeEmail,
            'country' => $this->faker->country,
            'id_number' => $this->faker->randomNumber(8, true),
            'id_photo_front' => $this->faker->imageUrl(640, 480, 'business', true),
            'id_photo_back' => $this->faker->imageUrl(640, 480, 'business', true),
            'selfie_with_id' => $this->faker->imageUrl(640, 480, 'people', true),
            'sponsor_id' => $this->faker->uuid,
            'is_subscribed' => $this->faker->boolean,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => fake()->streetAddress(),
            'preview_image_src' => '',
            'price_in_euros' => fake()->numberBetween(500, 5000),
            'parking_spaces' => fake()->numberBetween(1, 3),
            'bathrooms' => fake()->numberBetween(1, 2),
            'living_rooms' => fake()->numberBetween(1, 5),
            'available_from' => new DateTime('+2 days'),
            'available_to' => fake()->dateTimeBetween('+5 days', '+5 weeks'),
            'available' => true,
        ];
    }
}

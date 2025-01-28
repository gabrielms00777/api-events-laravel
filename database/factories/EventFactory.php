<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence,
            'description' => fake()->paragraph,
            'location' => fake()->address,
            'max_participants' => fake()->numberBetween(10, 100),
            'start_date' => fake()->dateTimeBetween('+1 day', '+7 days'),
            'end_date' => fake()->dateTimeBetween('+8 days', '+14 days'),
            'image_url' => fake()->imageUrl,
        ];
    }

}

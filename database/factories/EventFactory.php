<?php

namespace Database\Factories;

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
            'start_date' => fake()->dateTime,
            'end_date' => fake()->dateTime,
            'owner_id' => User::factory(),
        ];
    }
}

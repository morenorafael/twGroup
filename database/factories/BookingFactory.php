<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement([1, 2, 3]),
            'reserved_for' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'room_id' => Room::factory(),
            'user_id' => User::factory(),
        ];
    }
}

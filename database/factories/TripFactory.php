<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    public function definition(): array
    {
        $departureDate = $this->faker->dateTimeBetween('+1 week', '+1 month');
        $returnDate = clone $departureDate;
        $returnDate->modify('+' . rand(1, 7) . ' days');

        return [
            'user_id' => User::factory(),
            'destination_name' => $this->faker->city(),
            'destination_type' => $this->faker->randomElement(['pantai', 'gunung', 'kota']),
            'transportation' => $this->faker->randomElement(['pesawat', 'kereta', 'mobil', 'motor', 'bus', 'kapal']),
            'accommodation' => $this->faker->randomElement(['hotel', 'villa', 'camping', 'rumah_saudara']),
            'travel_style' => $this->faker->randomElement(['backpacker', 'regular', 'luxury']),
            'departure_date' => $departureDate->format('Y-m-d'),
            'return_date' => $returnDate->format('Y-m-d'),
            'has_medication' => $this->faker->boolean(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}

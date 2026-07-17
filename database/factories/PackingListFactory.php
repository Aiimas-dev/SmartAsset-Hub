<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackingListFactory extends Factory
{
    public function definition(): array
    {
        return [
            'trip_id' => Trip::factory(),
            'item_name' => $this->faker->randomElement([
                'Kaos', 'Celana', 'Pakaian Dalam', 'Charger HP', 'Perlengkapan Mandi',
                'Sunscreen', 'Sandal', 'Topi', 'Jaket', 'Sepatu Hiking',
                'Koper', 'KTP/Paspor', 'Sleeping Bag', 'Tenda',
            ]),
            'category' => $this->faker->randomElement(['pakaian', 'perlengkapan', 'dokumen', 'obat', 'makanan']),
            'quantity' => $this->faker->numberBetween(1, 5),
            'is_checked' => $this->faker->boolean(),
        ];
    }
}

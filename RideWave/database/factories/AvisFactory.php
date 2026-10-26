<?php

namespace Database\Factories;

use App\Models\Avis;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Avis>
 */
class AvisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reservation_id' => Reservation::factory()->create(['statut' => 'confirmee'])->id,
            'note' => fake()->numberBetween(4, 5),
            'commentaire' => fake()->randomElement([
                'Great ride and very punctual.',
                'Friendly driver and comfortable trip.',
                'Smooth experience from start to finish.',
                'Safe, easy, and well organized.',
                'Would happily book again.',
                'Comfortable vehicle and clear communication.',
            ]),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'passager')->inRandomOrder()->value('id')
                ?? User::factory()->create(['role' => 'passager'])->id,
            'trajet_id' => Trajet::factory(),
            'date_reservation' => fake()->dateTimeBetween('-30 days', 'now'),
            'nb_places' => fake()->numberBetween(1, 2),
            'statut' => fake()->randomElement(['confirmee', 'en_attente', 'annulee']),
        ];
    }
}

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
            'reservation_id' => Reservation::factory()->create(['statut' => 'confirmed']),
            'note' => fake()->numberBetween(3, 5),
            'commentaire' => fake()->randomElement([
                'Excellent trajet, très ponctuel !',
                'Conducteur sympathique et voiture confortable.',
                'Trajet agréable, je recommande.',
                'Très bonne expérience de covoiturage.',
                'Conducteur sérieux et respectueux.',
                'Économique et pratique.',
                'Parfait pour mes déplacements.',
                'Service de qualité.',
            ]),
        ];
    }
}
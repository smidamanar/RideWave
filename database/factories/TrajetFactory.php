<?php

namespace Database\Factories;

use App\Models\Trajet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trajet>
 */
class TrajetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = ['Tunis', 'Sfax', 'Sousse', 'Gabès', 'Bizerte', 'Nabeul', 'Monastir', 'Mahdia', 'Hammamet', 'Kairouan'];
        $depart = fake()->randomElement($cities);
        $destination = fake()->randomElement(array_diff($cities, [$depart]));

        return [
            'conducteur_id' => User::factory()->create(['role' => 'conducteur'])->id,
            'depart' => $depart,
            'destination' => $destination,
            'date' => fake()->dateTimeBetween('now', '+30 days'),
            'heure' => fake()->time('H:i'),
            'prix' => fake()->numberBetween(10, 100),
            'nb_places' => fake()->numberBetween(1, 4),
            'valide' => true,
        ];
    }
}
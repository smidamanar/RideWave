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
        $cities = ['Tunis', 'Sfax', 'Sousse', 'Gabes', 'Bizerte', 'Nabeul', 'Monastir', 'Mahdia', 'Hammamet', 'Kairouan'];
        $depart = fake()->randomElement($cities);
        $destination = fake()->randomElement(array_values(array_diff($cities, [$depart])));

        return [
            'conducteur_id' => User::where('role', 'conducteur')->inRandomOrder()->value('id')
                ?? User::factory()->create(['role' => 'conducteur'])->id,
            'depart' => $depart,
            'destination' => $destination,
            'date' => fake()->dateTimeBetween('-7 days', '+30 days'),
            'heure' => fake()->time('H:i'),
            'prix' => fake()->numberBetween(10, 45),
            'nb_places' => fake()->numberBetween(2, 4),
            'valide' => true,
        ];
    }
}

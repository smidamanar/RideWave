<?php

namespace Database\Factories;

use App\Models\Vehicule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicule>
 */
class VehiculeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => 'conducteur'])->id,
            'marque' => fake()->randomElement(['Peugeot', 'Renault', 'Citroën', 'Volkswagen', 'Ford', 'Toyota', 'Hyundai', 'Kia']),
            'modele' => fake()->randomElement(['208', '308', 'Clio', 'Megane', 'C3', 'C4', 'Golf', 'Polo', 'Fiesta', 'Yaris', 'i10', 'Picanto']),
            'annee' => fake()->numberBetween(2015, 2024),
            'couleur' => fake()->colorName(),
            'immatriculation' => strtoupper(fake()->bothify('??###???')),
            'places' => fake()->numberBetween(4, 7),
        ];
    }
}
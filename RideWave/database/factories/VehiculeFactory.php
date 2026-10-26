<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicule;
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
        $type = fake()->randomElement(array_keys(Vehicule::types()));

        return [
            'user_id' => User::where('role', 'conducteur')->inRandomOrder()->value('id')
                ?? User::factory()->create(['role' => 'conducteur'])->id,
            'type' => $type,
            'marque' => fake()->randomElement(['Peugeot', 'Renault', 'Citroen', 'Volkswagen', 'Ford', 'Toyota', 'Hyundai', 'Kia']),
            'modele' => fake()->randomElement(['208', '308', 'Clio', 'Megane', 'C3', 'C4', 'Golf', 'Polo', 'Fiesta', 'Yaris', 'i10', 'Picanto']),
            'annee' => fake()->numberBetween(2016, 2024),
            'couleur' => fake()->randomElement(['Black', 'White', 'Blue', 'Gray', 'Silver', 'Red']),
            'immatriculation' => strtoupper(fake()->bothify('??-###-??')),
            'places' => fake()->numberBetween(2, Vehicule::maxSeatsByType($type)),
        ];
    }
}

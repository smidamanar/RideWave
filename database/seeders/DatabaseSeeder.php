<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Trajet;
use App\Models\Reservation;
use App\Models\Avis;
use App\Models\Vehicule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@covoit.tn',
            'role' => 'admin',
            'telephone' => '+216 12 345 678',
        ]);

        // Create drivers with vehicles
        $drivers = User::factory(15)->create(['role' => 'conducteur']);
        foreach ($drivers as $driver) {
            Vehicule::factory()->create(['user_id' => $driver->id]);
        }

        // Create passengers
        User::factory(50)->create(['role' => 'passager']);

        // Create trajets
        Trajet::factory(30)->create();

        // Create reservations and reviews
        $trajets = Trajet::all();
        $passengers = User::where('role', 'passager')->get();

        foreach ($trajets as $trajet) {
            // Create 1-3 reservations per trajet
            $numReservations = fake()->numberBetween(1, 3);
            $selectedPassengers = $passengers->random(min($numReservations, $passengers->count()));

            foreach ($selectedPassengers as $passenger) {
                $reservation = Reservation::factory()->create([
                    'user_id' => $passenger->id,
                    'trajet_id' => $trajet->id,
                    'statut' => 'confirmed',
                ]);

                // 80% chance of having a review for completed reservations
                if (fake()->boolean(80)) {
                    Avis::factory()->create([
                        'reservation_id' => $reservation->id,
                    ]);
                }
            }
        }

        // Create some pending reservations
        Reservation::factory(10)->create(['statut' => 'pending']);
    }
}

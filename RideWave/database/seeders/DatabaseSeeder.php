<?php

namespace Database\Seeders;

use App\Models\Avis;
use App\Models\Reservation;
use App\Models\RideComment;
use App\Models\Trajet;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        if (app()->environment('production')) {
            throw new RuntimeException('The demo seeder may only be run outside production.');
        }

        $password = config('app.demo_user_password') ?: Str::random(40);

        Schema::disableForeignKeyConstraints();
        try {
            foreach (['avis', 'ride_comments', 'reservations', 'trajets', 'vehicules', 'notifications', 'personal_access_tokens', 'users'] as $table) {
                DB::table($table)->truncate();
            }
        } finally {
            Schema::enableForeignKeyConstraints();
        }

        $admins = collect([
            ['name' => 'Admin One', 'email' => 'admin1@ridewave.test', 'telephone' => '+21670000101'],
            ['name' => 'Admin Two', 'email' => 'admin2@ridewave.test', 'telephone' => '+21670000102'],
            ['name' => 'Admin Three', 'email' => 'admin3@ridewave.test', 'telephone' => '+21670000103'],
        ])->map(fn (array $row) => User::create($row + [
            'password' => $password,
            'role' => 'admin',
        ]));

        $drivers = collect([
            ['name' => 'Sami Ben Ali', 'email' => 'driver1@ridewave.test', 'telephone' => '+21670100101'],
            ['name' => 'Youssef Trabelsi', 'email' => 'driver2@ridewave.test', 'telephone' => '+21670100102'],
            ['name' => 'Nour Gharbi', 'email' => 'driver3@ridewave.test', 'telephone' => '+21670100103'],
            ['name' => 'Amine Khelifi', 'email' => 'driver4@ridewave.test', 'telephone' => '+21670100104'],
            ['name' => 'Rania Hammami', 'email' => 'driver5@ridewave.test', 'telephone' => '+21670100105'],
        ])->map(fn (array $row) => User::create($row + [
            'password' => $password,
            'role' => 'conducteur',
        ]));

        $passengers = collect([
            ['name' => 'Leila Chaabane', 'email' => 'passenger1@ridewave.test', 'telephone' => '+21670200101'],
            ['name' => 'Hatem Jaziri', 'email' => 'passenger2@ridewave.test', 'telephone' => '+21670200102'],
            ['name' => 'Meriem Ben Salem', 'email' => 'passenger3@ridewave.test', 'telephone' => '+21670200103'],
            ['name' => 'Walid Gafsi', 'email' => 'passenger4@ridewave.test', 'telephone' => '+21670200104'],
            ['name' => 'Ines Ayadi', 'email' => 'passenger5@ridewave.test', 'telephone' => '+21670200105'],
            ['name' => 'Tarek Bouzid', 'email' => 'passenger6@ridewave.test', 'telephone' => '+21670200106'],
            ['name' => 'Ons Saidi', 'email' => 'passenger7@ridewave.test', 'telephone' => '+21670200107'],
            ['name' => 'Farah Kooli', 'email' => 'passenger8@ridewave.test', 'telephone' => '+21670200108'],
            ['name' => 'Ahmed Mzoughi', 'email' => 'passenger9@ridewave.test', 'telephone' => '+21670200109'],
            ['name' => 'Sara Khemiri', 'email' => 'passenger10@ridewave.test', 'telephone' => '+21670200110'],
        ])->map(fn (array $row) => User::create($row + [
            'password' => $password,
            'role' => 'passager',
        ]));

        $vehicleData = [
            ['type' => 'car', 'marque' => 'Peugeot', 'modele' => '3008', 'annee' => 2022, 'couleur' => 'Silver', 'immatriculation' => 'DRV-001-TN', 'places' => 4],
            ['type' => 'suv', 'marque' => 'Renault', 'modele' => 'Kadjar', 'annee' => 2021, 'couleur' => 'Blue', 'immatriculation' => 'DRV-002-TN', 'places' => 4],
            ['type' => 'car', 'marque' => 'Toyota', 'modele' => 'Corolla', 'annee' => 2023, 'couleur' => 'White', 'immatriculation' => 'DRV-003-TN', 'places' => 4],
            ['type' => 'van', 'marque' => 'Hyundai', 'modele' => 'H1', 'annee' => 2020, 'couleur' => 'Black', 'immatriculation' => 'DRV-004-TN', 'places' => 6],
            ['type' => 'suv', 'marque' => 'Volkswagen', 'modele' => 'Tiguan', 'annee' => 2022, 'couleur' => 'Gray', 'immatriculation' => 'DRV-005-TN', 'places' => 5],
        ];

        $vehicles = $drivers->values()->map(function (User $driver, int $index) use ($vehicleData) {
            return Vehicule::create($vehicleData[$index] + ['user_id' => $driver->id]);
        });

        $routes = [
            ['Tunis', 'Sousse'],
            ['Sousse', 'Tunis'],
            ['Tunis', 'Nabeul'],
            ['Nabeul', 'Tunis'],
            ['Sfax', 'Mahdia'],
            ['Mahdia', 'Sfax'],
            ['Bizerte', 'Tunis'],
            ['Tunis', 'Bizerte'],
            ['Monastir', 'Sousse'],
            ['Sousse', 'Monastir'],
        ];

        $rides = collect();
        $now = Carbon::now();

        foreach ($drivers->values() as $driverIndex => $driver) {
            $vehicle = $vehicles[$driverIndex];

            for ($i = 0; $i < 2; $i++) {
                $route = $routes[($driverIndex * 2 + $i) % count($routes)];
                $isPast = ($driverIndex + $i) % 2 === 0;

                $rides->push(Trajet::create([
                    'conducteur_id' => $driver->id,
                    'vehicule_id' => $vehicle->id,
                    'depart' => $route[0],
                    'destination' => $route[1],
                    'date' => $isPast ? $now->copy()->subDays(rand(1, 14))->toDateString() : $now->copy()->addDays(rand(1, 14))->toDateString(),
                    'heure' => sprintf('%02d:%02d', rand(6, 20), [0, 15, 30, 45][rand(0, 3)]),
                    'prix' => rand(10, 28),
                    'nb_places' => max(2, min((int) $vehicle->places, 5)),
                    'valide' => true,
                    'smoking_allowed' => (bool) rand(0, 1),
                    'pets_allowed' => (bool) rand(0, 1),
                    'baggage_allowed' => true,
                    'food_drinks_allowed' => (bool) rand(0, 1),
                    'ac_included' => (bool) rand(0, 1),
                ]));
            }
        }

        $commentsPool = [
            'Great communication, thank you.',
            'Very smooth and safe trip.',
            'On time and comfortable ride.',
            'Clean car and friendly atmosphere.',
            'Would definitely book again.',
            'Everything went exactly as planned.',
        ];

        foreach ($rides as $rideIndex => $ride) {
            $candidatePassengers = $passengers->shuffle()->take(3)->values();
            $reserved = 0;

            foreach ($candidatePassengers as $passengerIndex => $passenger) {
                $remaining = max(1, $ride->nb_places - $reserved);
                $seats = min(1, $remaining);

                $status = Carbon::parse($ride->date)->isPast()
                    ? Reservation::STATUS_CONFIRMED
                    : ($passengerIndex === 0 ? Reservation::STATUS_PENDING : Reservation::STATUS_CONFIRMED);

                $reservation = Reservation::create([
                    'user_id' => $passenger->id,
                    'trajet_id' => $ride->id,
                    'date_reservation' => Carbon::parse($ride->date)->subDays(rand(1, 5))->toDateString(),
                    'nb_places' => $seats,
                    'statut' => $status,
                ]);

                $reserved += $seats;

                if (Carbon::parse($ride->date)->isPast() && $status === Reservation::STATUS_CONFIRMED && $passengerIndex < 2) {
                    Avis::create([
                        'reservation_id' => $reservation->id,
                        'note' => rand(4, 5),
                        'commentaire' => $commentsPool[array_rand($commentsPool)],
                    ]);
                }
            }

            $commentAuthorA = $passengers[$rideIndex % $passengers->count()];
            $commentAuthorB = $passengers[($rideIndex + 3) % $passengers->count()];

            $comment = RideComment::create([
                'trajet_id' => $ride->id,
                'user_id' => $commentAuthorA->id,
                'body' => $commentsPool[array_rand($commentsPool)],
            ]);

            RideComment::create([
                'trajet_id' => $ride->id,
                'user_id' => $commentAuthorB->id,
                'body' => $commentsPool[array_rand($commentsPool)],
            ]);

            RideComment::create([
                'trajet_id' => $ride->id,
                'user_id' => $ride->conducteur_id,
                'parent_id' => $comment->id,
                'body' => 'Thanks for your feedback. Looking forward to the next ride.',
            ]);
        }

        if ($this->command) {
            $this->command->info('Seed complete: 3 admins, 5 drivers, 10 passengers, 5 vehicles, 10 rides, reservations/comments/ratings.');
        }
    }
}

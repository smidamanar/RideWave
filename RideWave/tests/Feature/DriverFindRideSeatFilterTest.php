<?php

namespace Tests\Feature;

use App\Models\Trajet;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DriverFindRideSeatFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_find_rides_caps_seat_filter_to_selected_vehicle_type_limit(): void
    {
        $viewer = User::factory()->create([
            'role' => 'conducteur',
        ]);

        $driver = User::factory()->create([
            'role' => 'conducteur',
        ]);

        $vehicle = Vehicule::factory()->create([
            'user_id' => $driver->id,
            'type' => Vehicule::TYPE_CAR,
            'places' => 5,
        ]);

        Trajet::create([
            'conducteur_id' => $driver->id,
            'vehicule_id' => $vehicle->id,
            'depart' => 'Tunis',
            'destination' => 'Sousse',
            'date' => now()->addDay()->toDateString(),
            'heure' => '08:00',
            'prix' => 18,
            'nb_places' => 5,
            'valide' => true,
        ]);

        $response = $this->actingAs($viewer)->get(route('driver.find-rides', [
            'vehicle_type' => Vehicule::TYPE_CAR,
            'seats' => 55555,
        ]));

        $response->assertOk();
        $response->assertSee('id="seat-filter-input"', false);
        $response->assertSee('max="5"', false);
        $response->assertSee('value="5"', false);
        $response->assertSee('Max for Car: 5 seats');
        $response->assertDontSee('55555');
        $response->assertSee('1 ride found');
    }
}

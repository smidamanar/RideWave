<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DriverOfferRideSeatLimitTest extends TestCase
{
    use RefreshDatabase;

    public function test_offer_ride_page_uses_vehicle_type_limit_for_seat_picker(): void
    {
        $driver = User::factory()->create([
            'role' => 'conducteur',
        ]);

        $vehicle = Vehicule::factory()->create([
            'user_id' => $driver->id,
            'type' => Vehicule::TYPE_CAR,
            'places' => 6,
        ]);

        $response = $this->actingAs($driver)->get(route('driver.offer-ride.create'));

        $response->assertOk();
        $response->assertSee('data-seats="5"', false);
        $response->assertDontSee('data-seats="6"', false);
        $response->assertSee($vehicle->immatriculation);
    }

    public function test_driver_cannot_publish_more_seats_than_vehicle_type_allows(): void
    {
        $driver = User::factory()->create([
            'role' => 'conducteur',
        ]);

        $vehicle = Vehicule::factory()->create([
            'user_id' => $driver->id,
            'type' => Vehicule::TYPE_CAR,
            'places' => 6,
        ]);

        $response = $this->actingAs($driver)->post(route('driver.offer-ride.store'), [
            'vehicule_id' => $vehicle->id,
            'depart' => 'Tunis',
            'destination' => 'Sousse',
            'date' => now()->addDay()->toDateString(),
            'heure' => '09:00',
            'prix' => 25,
            'nb_places' => 6,
        ]);

        $response->assertSessionHasErrors([
            'nb_places' => 'This Car only supports up to 5 seats.',
        ]);
    }
}

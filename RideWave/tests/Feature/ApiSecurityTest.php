<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_registration_cannot_create_an_admin_account(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Unexpected Admin',
            'email' => 'admin@example.test',
            'password' => 'secure-password',
            'role' => 'admin',
        ]);

        $response->assertUnprocessable()->assertJsonValidationErrors('role');
        $this->assertDatabaseMissing('users', [
            'email' => 'admin@example.test',
        ]);
    }

    public function test_api_routes_require_authentication(): void
    {
        $this->getJson(route('trajets.index'))->assertUnauthorized();
    }

    public function test_api_reservations_are_limited_to_the_authenticated_user(): void
    {
        $passenger = User::factory()->create(['role' => 'passager']);
        $otherPassenger = User::factory()->create(['role' => 'passager']);
        $ownedReservation = Reservation::factory()->create(['user_id' => $passenger->id]);
        $otherReservation = Reservation::factory()->create(['user_id' => $otherPassenger->id]);

        $this->actingAs($passenger)
            ->getJson(route('reservations.index'))
            ->assertOk()
            ->assertJsonFragment(['id' => $ownedReservation->id])
            ->assertJsonMissing(['id' => $otherReservation->id]);

        $this->actingAs($passenger)
            ->deleteJson(route('reservations.destroy', $otherReservation))
            ->assertNotFound();

        $this->assertDatabaseHas('reservations', [
            'id' => $otherReservation->id,
        ]);
    }

    public function test_api_driver_cannot_delete_another_drivers_vehicle(): void
    {
        $driver = User::factory()->create(['role' => 'conducteur']);
        $vehicleOwner = User::factory()->create(['role' => 'conducteur']);
        $vehicle = Vehicule::factory()->create(['user_id' => $vehicleOwner->id]);

        $this->actingAs($driver)
            ->deleteJson(route('vehicules.destroy', $vehicle))
            ->assertForbidden();

        $this->assertDatabaseHas('vehicules', [
            'id' => $vehicle->id,
        ]);
    }
}

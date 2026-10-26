<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_register_as_a_passenger(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'RideWave Passenger',
            'email' => 'passenger@example.test',
            'password' => 'secure-password',
            'password_confirmation' => 'secure-password',
            'role' => 'passenger',
        ]);

        $response->assertRedirect(route('passenger.home'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'passenger@example.test',
            'role' => 'passager',
        ]);
    }

    public function test_a_user_can_log_in_and_log_out(): void
    {
        $user = User::factory()->create([
            'email' => 'passenger@example.test',
            'password' => 'secure-password',
            'role' => 'passager',
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'secure-password',
        ])->assertRedirect(route('passenger.home'));

        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))->assertRedirect('/');

        $this->assertGuest();
    }

    public function test_registration_cannot_create_an_admin_account(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Unexpected Admin',
            'email' => 'admin@example.test',
            'password' => 'secure-password',
            'password_confirmation' => 'secure-password',
            'role' => 'admin',
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertDatabaseMissing('users', [
            'email' => 'admin@example.test',
        ]);
    }

    public function test_an_unrecognized_role_is_not_treated_as_an_admin(): void
    {
        $user = new User(['role' => 'unexpected']);

        $this->assertSame('unknown', $user->canonicalRole());
        $this->assertSame('passenger.home', $user->homeRouteName());
    }

    public function test_notification_redirect_does_not_accept_external_urls(): void
    {
        $user = User::factory()->create([
            'role' => 'passager',
        ]);

        $this->from(route('passenger.home'))
            ->actingAs($user)
            ->post(route('notifications.read-all'), [
                'redirect_to' => 'https://attacker.example/',
            ])
            ->assertRedirect(route('passenger.home'));
    }
}

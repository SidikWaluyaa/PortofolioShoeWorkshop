<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }

    public function test_new_users_can_register_with_phone(): void
    {
        $response = $this->post('/register', [
            'name' => 'Phone User',
            'email' => 'phone@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '08123456789',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));

        // Verify the phone is normalized with 62 prefix
        $this->assertDatabaseHas('users', [
            'email' => 'phone@example.com',
            'phone' => '628123456789',
        ]);
    }
}

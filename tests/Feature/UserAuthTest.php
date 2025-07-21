<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Lucas Gabriel',
            'email' => 'lucas@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', [
            'email' => 'lucas@example.com',
        ]);
        $this->assertAuthenticated();
    }

    public function test_a_user_cannot_register_with_invalid_data()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => '123',
            'password_confirmation' => '456',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest();
    }

    public function test_a_user_cannot_register_with_existing_email()
    {
        User::factory()->create([
            'email' => 'lucas@example.com',
        ]);

        $response = $this->post('/register', [
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    public function test_a_user_can_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function test_a_user_cannot_login_with_invalid_credentials()
    {
        User::factory()->create([
            'email' => 'lucas@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'lucas@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function test_a_logged_in_user_can_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}

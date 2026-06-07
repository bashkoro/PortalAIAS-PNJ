<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_is_redirected_to_dashboard(): void
    {
        // Adjust the route '/register' and payload based on your actual registration implementation
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        // Adjust the redirect route if your app redirects elsewhere after registration
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_user_can_login_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        // Adjust the route '/login' if different
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_unauthenticated_user_cannot_access_dashboard(): void
    {
        // Adjust '/dashboard' to your actual protected route
        $response = $this->get('/dashboard');

        // Adjust if your app redirects to a different login path
        $response->assertRedirect('/login');
    }
}

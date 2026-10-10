<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_login_and_logout_routes_exist(): void
    {
        $this->get(route('register'))->assertOk();
        $this->get(route('login'))->assertOk();
        $this->post(route('register'), [
            'name' => 'Lab Student',
            'email' => 'student@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'student@example.com']);
        $this->post(route('logout'))->assertRedirect('/');
        $this->assertGuest();
        $this->post(route('login'), ['email' => 'student@example.com', 'password' => 'password123'])
            ->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs(User::where('email', 'student@example.com')->first());
    }
}

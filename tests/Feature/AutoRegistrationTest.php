<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutoRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register_and_login_by_tg(): void
    {
        $response = $this->post('/register-auto', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'social_id' => '1',
            'auth_token' => '123456789'
        ]);

        $this->assertAuthenticated();
        $response = $this->post('/logout');
        $response = $this->post('/login-auto', [
            'social_id' => '1',
            'auth_token' => '123456789',
        ]);

        $this->assertAuthenticated();
    }
}

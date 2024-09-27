<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AutoRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_register_and_login_by_tg(): void
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

    public function test_create_user(): void
    {
        $this->assertNull(User::first());
        $response = $this->post('/register-auto', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'social_id' => '1',
            'auth_token' => '123456789'
        ]);

        $this->assertAuthenticated();
        $this->assertCount(1, User::all());

        $user = User::first();
        $userResponse = (object)$response->json();
        $authUser = Auth::user();

        $this->assertNotNull($authUser);
        $this->assertEquals($authUser->id, $user->id);
        $this->assertEquals($authUser->id, $userResponse->id);

    }

    public function test_create_user_with_content(): void
    {
        $this->assertNull(User::first());
        $response = $this->post('/register-auto', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'contact_email' => 'contact@example.com',
            'contact_tel' => '123456789',
            'social_id' => '1',
            'social_type' => 'tg',
            'auth_token' => '123456789',
            'first_name' => 'First',
            'middle_name' => 'Middle',
            'last_name' => 'Last',
            'birthday' => '2024-12-12',
            'age' => 45,
            'gender' => 1,
            'region' => 'Novosibirsk',
            'address' => 'Russia, Novosibirsk',
            'user_data' => ['extra' => 'Extra'],
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 1);

        $user = User::first();
        $userResponse = (object)$response->json();
        $authUser = Auth::user();

        $this->assertNotNull($authUser);
        $this->assertEquals($authUser->id, $user->id);
        $this->assertEquals($authUser->id, $userResponse->id);

        $this->assertEquals($user->name, 'Test User');
        $this->assertEquals($user->email, 'test@example.com');
        $this->assertEquals($user->contact_email, 'contact@example.com');
        $this->assertEquals($user->contact_tel, '123456789');
        $this->assertEquals($user->social_id, '1');
        $this->assertEquals($user->social_type, 'tg');
        $this->assertEquals($user->auth_token, '123456789');

        $this->assertEquals($user->first_name, 'First');
        $this->assertEquals($user->middle_name, 'Middle');
        $this->assertEquals($user->last_name, 'Last');
        $this->assertEquals($user->birthday, '2024-12-12');
        $this->assertEquals($user->age, 45);
        $this->assertEquals($user->gender, 1);
        $this->assertEquals($user->region, 'Novosibirsk');
        $this->assertEquals($user->address, 'Russia, Novosibirsk');
        $this->assertEquals($user->user_data, ['extra' => 'Extra']);

    }
}

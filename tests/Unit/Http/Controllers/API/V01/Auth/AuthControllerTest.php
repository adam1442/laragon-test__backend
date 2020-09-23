<?php

namespace Tests\Unit\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\API\V01\Auth\AuthController;
//use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * register test
     */
    public function test_register_should_be_validate()
    {
        $response = $this->postJson('/api/v1/auth/register');
        $response->assertStatus(422);
    }

    public function test_new_user_can_register()
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'masih razavi',
            'email' => 'masih.r.1442@gmail.com',
            'password' => '14421442'
        ]);
        $response->assertStatus(201);
    }

    /**
     * login test
     */

    public function test_login_should_be_validate()
    {
        $response = $this->postJson(route('user.login'));
        $response->assertStatus(422);
    }

    public function test_login_user_true_credential()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->postJson(route('user.login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o registro de um novo usuário.
     */
    public function test_register_creates_user_and_returns_token()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure(['user', 'token']);

        $this->assertDatabaseHas('clientes', [
            'email' => 'john.doe@example.com',
        ]);
    }

    /**
     * Testa o login com credenciais válidas.
     */
    public function test_login_with_valid_credentials_returns_token()
    {
        $user = Cliente::factory()->create([
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
        ]);

        $credentials = [
            'email' => $user->email,
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $credentials);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }

    /**
     * Testa o login com credenciais inválidas.
     */
    public function test_login_with_invalid_credentials_returns_unauthorized()
    {
        $credentials = [
            'email' => 'invalid@example.com',
            'password' => 'wrongpassword',
        ];

        $response = $this->postJson('/api/login', $credentials);

        $response->assertStatus(401)
                 ->assertJson(['error' => 'Invalid credentials']);
    }

    /**
     * Testa a obtenção do usuário autenticado.
     */
    public function test_get_authenticated_user_returns_user_details()
    {
        $user = Cliente::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->getJson('/api/user/me', [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertStatus(200)
                 ->assertJson(['user' => ['id' => $user->id]]);
    }

    /**
     * Testa o logout de um usuário.
     */
    public function test_logout_invalidates_token()
    {
        $user = Cliente::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->postJson('/api/user/logout', [], [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Successfully logged out']);
    }

}

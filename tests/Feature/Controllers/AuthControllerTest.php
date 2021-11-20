<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    public function test_can_get_jwt()
    {
        // Arrange
        User::factory()->create([
            'email' => 'test@example.org',
            'password' => bcrypt('secret')
        ]);

        // Act
        $response = $this->json('POST', '/api/auth/login', [
            'email' => 'test@example.org',
            'password' => 'secret'
        ]);

        // Assert
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }
}

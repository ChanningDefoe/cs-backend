<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * Send json request as client
     *
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @param User $user
     *
     * @return TestResponse
     */
    public function jsonAsUser(string $method, string $url, array $data = [], array $headers = [], User $user = null) : TestResponse
    {
        $accessToken = $this->getAccessToken($user);

        return $this->json($method, $url, $data, array_merge([
            'Authorization' => "Bearer {$accessToken}",
        ], $headers));
    }

    /**
     * Get access token
     * 
     * @param User $user
     * 
     * @return string
     */
    public function getAccessToken(User $user = null) : string
    {
        if (!$user) {
            $user = User::factory()->create();
        }

        return auth()->login($user);
    }
}

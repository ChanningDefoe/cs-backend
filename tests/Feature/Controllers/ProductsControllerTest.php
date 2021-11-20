<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class ProductsControllerTest extends TestCase
{
    public function test_can_get_products()
    {
        // Act
        $response = $this->jsonAsUser('GET', '/api/products');

        // Assert
    }

    public function test_cannot_get_products_as_unauthenticated_user()
    {
        // Act
        $response = $this->json('GET', '/api/products');

        // Assert
        $response->assertStatus(401);
    }
}

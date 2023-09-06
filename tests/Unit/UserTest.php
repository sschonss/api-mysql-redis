<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function listUsers(): void
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }

    public function createUser(): void
    {
        $response = $this->post('/api/users', [
            'name' => 'Test User',
            'email' => 'test@user.com',
            'password' => '123456',
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'success' => true,
            'message' => 'User Created',
            'data' => [
                'name' => 'Test User',
                'email' => 'test@user.com',
                'password' => '123456',
            ],
        ]);

    }
}

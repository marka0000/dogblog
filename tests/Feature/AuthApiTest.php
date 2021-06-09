<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    public function testRegisterSuccess()
    {
        $data = [
            'name' => Str::random(6),
            'nickname' => Str::random(8),
            'email' => Str::random(6) . '@test.com',
            'password' => 'testtesttest',
        ];

        $this->post('api/register', $data)
            ->assertStatus(201);
    }

    public function testLoginSuccess()
    {
        $data = [
            'email' => 'naxNMX@test.com',
            'password' => 'testtesttest',
        ];

        $this->post('api/login', $data)
            ->assertStatus(201);
    }

    public function testLoginMissing()
    {
        $data = [
            'email' => 'test@test.com',
            'password' => 'testtesttest',
        ];

        $this->post('api/login', $data)
            ->assertStatus(404);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostTest extends TestCase
{

    public function testPostsShowSuccess()
    {
        $header = [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
            'Accept' => 'application/json',
        ];
        $this->get('api/posts', $header)
            ->assertStatus(200);
    }

    public function testPostShowSuccess()
    {
        $header = [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
            'Accept' => 'application/json',
        ];
        $this->get('api/posts/' . $this->getIntSuccess(), $header)
            ->assertStatus(200);
    }

    public function testPostShowMissing()
    {
        $header = [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
            'Accept' => 'application/json',
        ];
        $this->get('api/posts/' . $this->getIntMissing(), $header)
            ->assertStatus(404);
    }

    public function testPostCreatedSuccess()
    {
        $header = [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
            'Accept' => 'application/json',
        ];
        $data = [
            'title' => 'Dog post blog',
            'sub_title' => 'Post about very small dog',
            'content' => 'The little dog loves to play ball',
            'user_id' => $this->getIntSuccess(),
        ];
        $this->post('api/posts', $data, $header)
            ->assertStatus(201);
    }

    public function testPostUpdatedSuccess()
    {
        $header = [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
            'Accept' => 'application/json',
        ];
        $data = [
            'title' => 'Title updated after test',
            'sub_title' => 'Title updated after test',
            'content' => 'Title updated after test',
            'user_id' => $this->getIntSuccess(),
        ];
        $this->put('api/posts/4', $data, $header)
            ->assertStatus(200);
    }

    public function testPostUpdatedMissing()
    {
        $header = [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
            'Accept' => 'application/json',
        ];
        $data = [
            'title' => 'Title updated after test',
            'sub_title' => 'Title updated after test',
            'content' => 'Title updated after test',
            'user_id' => $this->getIntSuccess(),
        ];
        $this->put('api/posts/' . $this->getIntMissing(), $data, $header)
            ->assertStatus(404);
    }

    public function testPostDeletedSucces()
    {
        $header = [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
            'Accept' => 'application/json',
        ];
        $this->delete('api/posts/6', [], $header)
            ->assertStatus(204);
    }

    public function testPostDeletedMissing()
    {
        $header = [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
            'Accept' => 'application/json',
        ];
        $this->delete('api/posts/' . $this->getIntMissing(), [], $header)
            ->assertStatus(404);
    }

    private function getApiToken()
    {
        $header = [
            'Accept' => 'application/json'
        ];

        $data = [
            'name' => Str::random(6),
            'nickname' => Str::random(8),
            'email' => Str::random(6) . '@test.com',
            'password' => '$2y$10$92oXUNpkkO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ];

        $response = $this->post('api/register', $data, $header);
        return $response->original['token'];
    }

    private function getIntSuccess()
    {
        return random_int(1, 5);
    }

    private function getIntMissing()
    {

        return random_int(100, 200);
    }
}

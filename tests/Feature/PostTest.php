<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function testPostsShowSuccess()
    {
        $this->get('api/posts')
            ->assertStatus(200);
    }

    public function testPostShowSuccess()
    {
        $this->get('api/posts/')
            ->assertStatus(200);
    }

    public function testPostShowMissing()
    {
        $this->get('api/posts/' . $this->getIntMissing())
            ->assertStatus(404);
    }

    public function testPostCreatedSuccess()
    {
        $data = [
            'title' => 'Dog post blog',
            'sub_title' => 'Post about very small dog',
            'content' => 'The little dog loves to play ball',
            'user_id' => 1,
        ];
        $this->post('api/posts', $data)
            ->assertStatus(201);
    }

    public function testPostUpdatedSuccess()
    {
        $data = [
            'title' => 'Title updated after test',
            'sub_title' => 'Title updated after test',
            'content' => 'Title updated after test',
            'user_id' => $this->getIntSuccess(),
        ];
        $this->put('api/posts/10', $data)
            ->assertStatus(200);
    }

    public function testPostUpdatedMissing()
    {
        $data = [
            'title' => 'Title updated after test',
            'sub_title' => 'Title updated after test',
            'content' => 'Title updated after test',
            'user_id' => 1,
        ];
        $this->put('api/posts/' . $this->getIntMissing(), $data)
            ->assertStatus(404);
    }

    public function testPostDeletedSucces()
    {
        $this->delete('api/posts/19')
            ->assertStatus(204);
    }

    public function testPostDeletedMissing()
    {
        $this->delete('api/posts/' . $this->getIntMissing())
            ->assertStatus(404);
    }

    private function getIntSuccess()
    {
        return random_int(1, 10);
    }

    private function getIntMissing()
    {

        return random_int(100,200);
    }
}

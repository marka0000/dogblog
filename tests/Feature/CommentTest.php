<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testPostCreatedSuccess()
    {
        $data = [
            'comment' => 'New comment after test',
            'user_id' => $this->getIntSuccess(),
            'post_id' => $this->getIntSuccess(),
        ];
        $this->post('api/comments', $data)
            ->assertStatus(201);
    }

    private function getIntSuccess()
    {
        return random_int(1, 5);
    }
}

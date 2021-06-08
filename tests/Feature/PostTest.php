<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function testRegisterApi()
    {
        $header = ['Accept: application/json'];

        $data = [
            'name' => Str::random(6),
            'nickname' => Str::random(8),
            'email' => Str::random(6) . '@test.com',
            'password' => '$2y$10$92oXUNpkkO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ];

        $this->post('api/register', $data, $header)
            ->assertStatus(201);
    }

//    public function testPostsShowSuccess()
//    {
//        $this->get('api/posts')
//            ->assertStatus(200);
//    }
//
//    public function testPostShowSuccess()
//    {
//        $this->get('api/posts/' . $this->getIntSuccess())
//            ->assertStatus(200);
//    }
//
//    public function testPostShowMissing()
//    {
//        $this->get('api/posts/' . $this->getIntMissing())
//            ->assertStatus(404);
//    }
//
//    public function testPostCreatedSuccess()
//    {
//        $data = [
//            'title' => 'Dog post blog',
//            'sub_title' => 'Post about very small dog',
//            'content' => 'The little dog loves to play ball',
//            'user_id' => $this->getIntSuccess(),
//        ];
//        $this->post('api/posts', $data)
//            ->assertStatus(201);
//    }
//
//    public function testPostUpdatedSuccess()
//    {
//        $data = [
//            'title' => 'Title updated after test',
//            'sub_title' => 'Title updated after test',
//            'content' => 'Title updated after test',
//            'user_id' => $this->getIntSuccess(),
//        ];
//        $this->put('api/posts/4', $data)
//            ->assertStatus(200);
//    }
//
//    public function testPostUpdatedMissing()
//    {
//        $data = [
//            'title' => 'Title updated after test',
//            'sub_title' => 'Title updated after test',
//            'content' => 'Title updated after test',
//            'user_id' => $this->getIntSuccess(),
//        ];
//        $this->put('api/posts/' . $this->getIntMissing(), $data)
//            ->assertStatus(404);
//    }
//
//    public function testPostDeletedSucces()
//    {
//        $this->delete('api/posts/6')
//            ->assertStatus(204);
//    }
//
//    public function testPostDeletedMissing()
//    {
//        $this->delete('api/posts/' . $this->getIntMissing())
//            ->assertStatus(404);
//    }

    private function getIntSuccess()
    {
        return random_int(1, 5);
    }

    private function getIntMissing()
    {

        return random_int(100, 200);
    }
}

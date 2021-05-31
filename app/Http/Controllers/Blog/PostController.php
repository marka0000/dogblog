<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function posts()
    {
        return response()->json(Post::all(), 200);
    }

    public function postById($id)
    {
        $post = Post::all()->find($id);
//        $post = DB::table('posts')
//            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
//            ->where('posts.id', '=', $id)
//            ->get();
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($post, 200);
    }

    public function postSave(Request $request)
    {
        $post = Post::created($request->all());
        return response()->json($post, 201);
    }

    public function postEdit(Request $request, $id)
    {
        $post = Post::all()->find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post->update($request->all());
        return response()->json($post, 200);

    }

    public function postDelete($id)
    {
        $post = Post::all()->find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post->delete();
        return response()->json('', 204);
    }
}

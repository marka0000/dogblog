<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Post::with('author')->get();
        $comment = Post::with('comment')->get();

        $collection = collect($author);
        $merged     = $collection->merge($comment);
        $post[]   = $merged->all();

        return response()->json($post, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Post::with('author')->find($id);
        $comment = Post::with('comment')->find($id);

        $collection = collect($author);
        $merged     = $collection->merge($comment);
        $post[]   = $merged->all();

        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($post, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::all()->find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post->update($request->all());
        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::all()->find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post->delete();
        return response()->json('', 204);
    }
}

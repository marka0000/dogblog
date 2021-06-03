<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response()->json(Post::all(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Post::all()->find($id);
//        $post = DB::table('posts')
//            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
//            ->where('posts.id', '=', $id)
//            ->get();
        if (is_null($data)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Post::create($request->all());
        return response()->json($data, 201);
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
        $data = Post::all()->find($id);
        if (is_null($data)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $data->update($request->all());
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Post::all()->find($id);
        if (is_null($data)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $data->delete();
        return response()->json('', 204);
    }
}

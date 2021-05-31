<?php

use App\Http\Controllers\Blog\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', [PostController::class, 'posts']);
Route::get('post/{id}', [PostController::class, 'postById']);

Route::post('post', [PostController::class, 'postSave']);

Route::put('post/{id}', [PostController::class, 'postEdit']);

Route::delete('post/{id}', [PostController::class, 'postDelete']);

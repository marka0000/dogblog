<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RegisterController;
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

Route::post('register', [RegisterController::class, 'register']);
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{post}', [PostController::class, 'show']);
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
});

//Route::middleware('auth:api')->get('posts', [PostController::class, 'index']);
//Route::middleware('auth:api')->get('posts/{post}', [PostController::class, 'show']);
//Route::middleware('auth:api')->post('posts', [PostController::class, 'store']);
//Route::middleware('auth:api')->put('posts/{post}', [PostController::class, 'update']);
//Route::middleware('auth:api')->delete('posts/{post}', [PostController::class, 'destroy']);

//Route::get('posts', [PostController::class, 'index']);
//Route::get('posts/{post}', [PostController::class, 'show']);
//Route::post('posts', [PostController::class, 'store']);
//Route::put('posts/{post}', [PostController::class, 'update']);
//Route::delete('posts/{post}', [PostController::class, 'destroy']);

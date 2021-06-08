<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Вынести в отдельный Request
        $fields = $request->validate([
            'name' => 'required|string',
            'nickname' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'nickname' => $fields['nickname'],
            'email' => $fields['email'],
            'password' => $fields['password'],
        ]);

        $token = $user->createToken('dogblog')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
//        $fields = $request->validate([
//            'email' => 'required|string',
//            'password' => 'required|string'
//        ]);
//
//        $user = User::create([
//            'email' => $fields['email'],
//            'password' => bcrypt($fields['password']),
//        ]);
//
//        $token = $user->createToken('myapptoken')->plainTextToken;
//
//        $response = [
//            'user' => $user,
//            'token' => $token
//        ];
//
//        return response()->json($response, 201);
    }
}

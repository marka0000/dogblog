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
            'password' => bcrypt($fields['password']),
        ]);

        $userNickname = $user->getAttribute('nickname');
        $token = $user->createToken($userNickname)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        $userNickname = $user->getAttribute('nickname');
        $token = $user->createToken($userNickname)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }
}

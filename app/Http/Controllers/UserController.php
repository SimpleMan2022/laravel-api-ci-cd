<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(UserRequest $userRequest)
    {
        $validated = $userRequest->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $token = $user->createToken("$user->name-auth_token")->plainTextToken;
        return ResponseHelper::respond(201, 'User created successfully', ['token' => $token]);
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $validate['email'])->first();

        if (!$user || !Hash::check($validate['password'], $user->password)) {
            return ResponseHelper::respond(401, 'Unauthorized');
        }
        // $user->tokens()->delete();
        $token = $user->createToken("$user->name-auth_token")->plainTextToken;
        return ResponseHelper::respond(200, 'Login successful', ['token' => $token]);
    }
}

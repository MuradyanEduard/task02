<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\auth\LoginRequest;
use App\Http\Requests\API\auth\RegisterRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Author;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['errors' => ['email' => 'Login or password is wrong!']], 400);
        }

        Auth::attempt($request->only('email', 'password'));
        $user = Auth::user();

        return response()->json(['user' => $user]);
    }

    public function register(RegisterRequest $request)
    {
        $author = Author::create([
            'name' => $request['name'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => Str::random(80),
            'role' => $request['role'],
            'author_id' => $author->id
        ]);

        // dd($user->api_token);
//
        return response()->json(['message' => 'User successfuly created!']);
    }
}
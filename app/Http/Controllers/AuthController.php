<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        $token = $this->createJwtToken($user->id);

        // return response()->json(['user' => $user, 'token' => $token], 201);
        return redirect()->route('newsletter.index')->cookie('jwt', $token, 60);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json(['error' => 'Invalid credentials.'], 401);
        }

        $token = $this->createJwtToken($user->id);

        // return response()->json(['user' => $user, 'token' => $token], 200);
        return redirect()->route('newsletter.index')->cookie('jwt', $token, 60);

    }

    protected function createJwtToken($userId)
    {
        $payload = [
            'iss' => env('APP_URL'),
            'sub' => $userId,
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60 * 60 // Expiration time is 1 hour.
        ];

        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }
}

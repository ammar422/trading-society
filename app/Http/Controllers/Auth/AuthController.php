<?php

namespace App\Http\Controllers\Auth;



use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Register user and generate token
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'token created successfully',
            'token' => $user->createToken('USER Token')->plainTextToken
        ], 201);
    }


    
    // Login user and generate token
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw new HttpResponseException(
                response()->json([
                    'status' => false,
                    'message' => 'The provided credentials are incorrect.'
                ], 403)
            );
        }

        return response()->json([
            'status' => true,
            'message' => 'token created successfully',
            'token' => $user->createToken('USER Token')->plainTextToken
        ], 201);
    }



    // Logout user (revoke token)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully',
        ]);
    }
}

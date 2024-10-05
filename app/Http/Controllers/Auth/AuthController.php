<?php

namespace App\Http\Controllers\Auth;



use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Traits\MediaTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use MediaTrait;
    // Register user and generate token
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $id_front_photo = $this->saveImage('users_IDs_photo', $request->id_photo_front);
        $id_back_photo = $this->saveImage('users_IDs_photo', $request->id_photo_back);
        $selfie = $this->saveImage('users_IDs_photo', $request->selfie_with_id);
        $data['id_photo_front'] = $id_front_photo;
        $data['id_photo_back'] = $id_back_photo;
        $data['selfie_with_id'] = $selfie;
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
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

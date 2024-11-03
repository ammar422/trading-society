<?php

namespace App\Http\Controllers\Api\Auth;



use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Traits\MediaTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use MediaTrait;
    // Register user and generate token
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('id_photo_front')) {
            $id_front_photo = $this->saveImage('users_IDs_photo', $request->id_photo_front);
            $data['id_photo_front'] = $id_front_photo;
        }

        if ($request->hasFile('id_photo_back')) {
            $id_back_photo = $this->saveImage('users_IDs_photo', $request->id_photo_back);
            $data['id_photo_back'] = $id_back_photo;
        }

        if ($request->hasFile('selfie_with_id')) {
            $selfie = $this->saveImage('users_IDs_photo', $request->selfie_with_id);
            $data['selfie_with_id'] = $selfie;
        }
        $profile_image = $this->saveImage('profile_images', $request->profile_image);
        $data['profile_image'] = $profile_image;
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
            'token' => $user->createToken('USER Token')->plainTextToken,
            'user' => [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'user_first_name' => $user->first_name
            ]
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


    public function deleteUserAccount()
    {
        $user = auth()->user();
        $user->delete();
        $user->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'message' => 'account deleted successfully',
        ]);
    }


    public function getUserData()
    {
        $user = auth()->user();
        // $image_path = Str::after
        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'user data get successfully',
                'user' => [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'user_first_name' => $user->first_name,
                    'user_last_name' => $user->last_name,
                    'phone' => $user->phone_number,
                    'profile_image' => $user->profile_image,
                ]
            ], 201);
        }
        return response()->json([
            'status' => false,
            'message' => 'not found',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;



use App\Models\User;
use App\Traits\MediaTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

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
                    'package' => $user->package,
                    'subscripition_start_at' => $user->subscripition_start_at,
                    'subscripition_end_at' => $user->subscripition_end_at,
                ]
            ], 201);
        }
        return response()->json([
            'status' => false,
            'message' => 'not found',
        ]);
    }



    public function loginWithSSO(Request $request)
    {
        $response = Http::post('https://api.hfssociety.com/api/v1/login-token', [
            // $response = Http::post('http://127.0.0.1:7000/api/v1/login-token', [ //for testing only
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $token = $response->json('token');

            // Validate the token by calling HFS user data endpoint
            $userResponse = Http::withToken($token)->get('https://api.hfssociety.com/api/v1/get-login-user');
            // $userResponse = Http::withToken($token)->get('http://127.0.0.1:7000/api/v1/get-login-user'); // for testing only
            if ($userResponse->successful()) {
                $userData = $userResponse->json();

                // Check if the user exists
                $user = User::where('email', $userData['user']['email'])->first();

                if ($user) {
                    // Update existing user
                    $user->update([
                        'name' => $userData['user']['name'],
                        'first_name' => $userData['user']['name'],
                        // 'last_name' => $userData['last_name'],
                        'phone_number' => $userData['user']['phone'] ?? "unll from HFS",
                        'package' => $userData['user']['package_name'],
                        'subscripition_start_at' => $userData['user']['subscribed_at'],
                        'subscripition_end_at' => $userData['user']['expiration_date'],
                    ]);
                } else {
                    // Create a new user
                    $user = User::create([
                        'email'                    => $userData['user']['email'],
                        'name'                     => $userData['user']['name'],
                        'first_name'               => $userData['user']['name'],
                        'last_name'                => 'last_name',
                        'phone_number'             => $userData['user']['phone'] ?? "unll from HFS",
                        'password'                 => bcrypt(Str::random(10)),
                        'package'                  => $userData['user']['package_name'],
                        'subscripition_start_at'   => $userData['user']['subscribed_at'],
                        'subscripition_end_at'     => $userData['user']['expiration_date'],
                    ]);
                }

                Auth::login($user);
                return response()->json([
                    'status' => true,
                    'message' => 'Logged in successfully',
                    'token' => $user->createToken('USER Token')->plainTextToken,
                    'user' => $user
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials'
        ], 401);
    }




    public function syncUser(Request $request)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'name'                      => 'required|string|max:255',
            'email'                     => 'required|email',
            'phone_number'              => 'required|string|max:20',
            'package'                   => 'required|string|max:20',
            'subscripition_start_at'    => 'required|date',
            'subscripition_end_at'      => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->update([
                'name'                   => $data['name'],
                'first_name'             => $data['name'],
                'last_name'              => $data['name'],
                'phone_number'           => $data['phone_number'],
                'package'                => $data['package'],
                'subscripition_start_at' => $data['subscripition_start_at'],
                'subscripition_end_at'   => $data['subscripition_end_at'],
            ]);

            return response()->json([
                'status'    => true,
                'message'   => 'User updated successfully.',
                'token'     => $user->createToken('USER Token')->plainTextToken
            ], 200);
        }

        $data['password']       = bcrypt(Str::random(10));
        $data['first_name']     = $data['name'];
        $data['last_name']      = $data['name'];
        $user = User::create($data);


        return response()->json([
            'status'    => true,
            'message'   => 'User created successfully, and logedin',
            'token'     => $user->createToken('USER Token')->plainTextToken
        ], 201);
    }
}

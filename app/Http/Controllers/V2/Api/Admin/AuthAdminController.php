<?php

namespace App\Http\Controllers\V2\Api\Admin;

use App\Models\Instructor;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\V2\UpdateProfileRequest;
use App\Models\SuperAdmin;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthAdminController extends Controller
{
    // Login instructor and generate token
    public function login(LoginRequest $request)
    {
        $admin = SuperAdmin::where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
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
            'token' => $admin->createToken('admin Token')->plainTextToken,
            'admin' => [
                'id' => $admin->id,
                'email' => $admin->email,
                'name' => $admin->name
            ]
        ], 201);
    }



    /**
     * Get the authenticated User.
     *
     * @return object
     */
    public function me()
    {
        return $this->respondWithUserData(auth()->user());
    }

    protected function respondWithUserData($user, $message = null)
    {
        $message = $message ?? __('users::auth.data_get');
        return lynx()
            ->data([
                'user' => new UserResource($user),
            ])
            ->message($message)
            ->response();
    }

    public function editProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth('instructor-api')->user();
        if ($request->hasFile('photo')) {
            $path =  $this->imageProccessing($user, $request->file('photo'));
            $data['photo'] = $path;
        }
        $user->update($data);
        return $this->respondWithUserData($user, __('users::auth.data_udated'));
    }

    private function imageProccessing(Instructor $instructor, $newPhoto)
    {
        if (!empty($instructor->photo)) {
            $oldPhoto = Str::after($instructor->photo, env('APP_URL'));
            Storage::delete($oldPhoto);
        }
        !empty($newPhoto) ? $path = $newPhoto->store('users/' . $instructor->id) : $path = $instructor->photo;
        return $path;
    }
}

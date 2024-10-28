<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Instructor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthInstructorController extends Controller
{
    // Login instructor and generate token
    public function login(LoginRequest $request)
    {
        $instructor = Instructor::where('email', $request->email)->first();

        if (! $instructor || ! Hash::check($request->password, $instructor->password)) {
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
            'token' => $instructor->createToken('Instructor Token')->plainTextToken,
            'instructor' => [
                'instructor_id' => $instructor->id,
                'instructor_email' => $instructor->email,
                'instructor_name' => $instructor->name
            ]
        ], 201);
    }
}

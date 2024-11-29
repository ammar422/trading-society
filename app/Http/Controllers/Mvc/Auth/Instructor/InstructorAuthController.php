<?php

namespace App\Http\Controllers\Mvc\Auth\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\InstructorLoginRequest;

class InstructorAuthController extends Controller
{
    public function loginView()
    {
        return view('instructor_auth.login');
    }



    public function login(InstructorLoginRequest $request)
    {
        // Validate the credentials from the request  
        $credentials = [
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
        ];

        // Attempt to authenticate the instructor  
        if (Auth::guard('instructor')->attempt($credentials)) {
            // Retrieve the authenticated instructor  
            $instructor = Auth::guard('instructor')->user();

            // Check if the instructor's status is active  
            if ($instructor->status !== 'active') {
                // Log the instructor out if not active  
                Auth::guard('instructor')->logout();
                return redirect()->back()->with('error', 'Your account is not active. Please contact support or your Admin.');
            }

            // Redirect to the intended page if everything is fine  
            return redirect()->intended("/instructor/");
        }

        // If authentication fails, redirect back with an error  
        return redirect()->back()->with('error', 'Invalid credentials!');
    }

    public function logout()
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect()->route('login');
    }
}

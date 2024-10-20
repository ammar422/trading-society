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

        $credentials = [
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
        ];

        if (Auth::guard('instructor')->attempt($credentials)) {
            return redirect()->intended("/instructor/");
        }
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

<?php

namespace App\Http\Controllers\Mvc\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

class AdminAuthController extends Controller
{
    public function loginVeiw()
    {
        return view('admin.admin_auth.login');
    }



    public function login(AdminLoginRequest $request)
    {
        $credentials = [
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
        ];

        if (Auth::guard('super_admin')->attempt($credentials)) {
            return redirect()->intended("/admin/");
        }
        return redirect()->back()->with('error', 'Invalid credentials!');
    }
}

<?php

namespace App\Http\Controllers\Mvc\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function loginVeiw()
    {
        return view('admin.admin_auth.login');
    }



    public function login(AdminLoginRequest $request)
    {
        return $request;
    }
}

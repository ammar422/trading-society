<?php

namespace App\Http\Controllers\Auth\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorAuthController extends Controller
{
    public function loginView()
    {
        return view('instructor_auth.login');
    }
}

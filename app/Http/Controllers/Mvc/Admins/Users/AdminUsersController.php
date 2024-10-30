<?php

namespace App\Http\Controllers\Mvc\Admins\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index() //all active users
    {
        $users = User::where('status', 'active')->get();
        return view('admin.active_users', compact('users'));
    }


    public function Rindex() //all in-active users
    {
        $users = User::where('status', 'inactive')->get();
        return view('admin.inactive_users', compact('users'));
    }
}

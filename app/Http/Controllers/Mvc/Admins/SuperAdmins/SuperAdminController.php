<?php

namespace App\Http\Controllers\Mvc\Admins\SuperAdmins;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $super_admins = SuperAdmin::all();
        return view('admin.super_admins', compact('super_admins'));
    }
}

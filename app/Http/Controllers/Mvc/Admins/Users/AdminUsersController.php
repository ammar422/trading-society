<?php

namespace App\Http\Controllers\Mvc\Admins\Users;

use App\Models\User;
use App\Traits\MediaTrait;
use Illuminate\Support\Str;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;

class AdminUsersController extends Controller
{
    use MediaTrait;

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

    public function create()
    {
        return view('admin.new_user');
    }




    public function store(StoreUserRequest $request, ImageService $imageService)
    {
        $data = $request->validated();

        // Define image fields with their respective storage folders
        $imageFields = [
            'id_photo_front' => 'users_IDs_photo',
            'id_photo_back' => 'users_IDs_photo',
            'selfie_with_id' => 'users_IDs_photo',
            'profile_image' => 'profile_images',
        ];

        // Save images and add their paths to the data array
        foreach ($imageFields as $field => $folder) {
            if ($request->hasFile($field)) {
                $data[$field] = $imageService->saveImage($folder, $request->file($field));
            }
        }

        // Hash the password
        $data['password'] = bcrypt($request->password);

        // Wrap user creation in a transaction for consistency
        $user = null;
        DB::transaction(function () use ($data, &$user) {
            $user = User::create($data);
        });

        // Redirect based on user status
        $route = $user->status == 'active' ? 'admin.users.active' : 'admin.users.inactive';
        $message = ($user->status == 'active' || $user->status = 'inactive') ? 'User added successfully' : 'Something went wrong, try again later';

        return redirect()->route($route)->with('success', $message);
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request)
    {
        // 
    }

    public function destroy($id)
    {
        $user = User::find($id);
        // $profile_image = Str::after($user->profile_image, env('APP_URL'));
        // if (is_file(base_path() . $profile_image)) {

        //     return   "yes is file";
        // }
        // return 'nooooooooooo';
        $status = $user->status;
        $success = $user->delete();
        $route = $status == 'active' ? 'admin.users.active' : 'admin.users.inactive';
        if ($success)
            return redirect()->route($route)->with('success', 'User deleted successfully');
        return redirect()->route($route)->with('error', 'Something went wrong, try again later');
    }
}

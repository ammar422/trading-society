<?php

namespace App\Http\Controllers\Mvc\Admins\Instructors;

use App\Models\Instructor;
use App\Traits\MediaTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;

class AdminInstructorController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::all();
        return view('admin.instructor', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.new_instructor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $image = $this->saveImage('instructors_images', $request->validated('photo'));
            $data['photo'] = $image;
        }
        if ($request->hasFile('video')) {
            $video = $this->saveVideo('instructors_videos', $request->validated('photo'));
            $data['video'] = $video;
        }
        $data['password'] = bcrypt($request->validated('password'));
        $instructor = Instructor::create($data);
        if ($instructor)
            return redirect()->route('admin.instructor')->with('success', 'instructor created successfully');
        return redirect()->route('admin.instructor')->with('error', 'something went wrong , try again');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $instructor = Instructor::find($id);
        return view('admin.edit_instructor', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorRequest $request, string $id)
    {
        $instructor = Instructor::find($id);
        $old_photo = $instructor->photo;
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $image = $this->saveImage('instructors_images', $request->validated('photo'));
            $data['photo'] = $image;
        }
        if ($request->hasFile('video')) {
            $video = $this->saveVideo('instructors_videos', $request->validated('photo'));
            $data['video'] = $video;
        }
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->validated('password'));
        }
        $success =  $instructor->update($data);
        if ($success) {
            $path = Str::after($old_photo, env('APP_URL'));
            if (is_file(base_path() . $path)) {
                unlink(base_path() . $path);
            }
            return redirect()->route('admin.instructor')->with('success', 'instructor updated successfully');
        }
        return redirect()->route('admin.instructor')->with('error', 'something went wrong , try again');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $instructor = Instructor::find($id);
        $old_photo = $instructor->photo;
        $success =  $instructor->delete();
        if ($success) {
            $path = Str::after($old_photo, env('APP_URL'));
            if (is_file(base_path() . $path)) {
                unlink(base_path() . $path);
            }
            return redirect()->route('admin.instructor')->with('success', 'instructor delted successfully');
        }
        return redirect()->route('admin.instructor')->with('error', 'something went wrong , try again');
    }



    public function changeStatus($id)
    {
        $instructor = Instructor::find($id);
        if ($instructor->status == 'active') {
            $instructor->update(['status' => 'inactive']);
            return redirect()->route('admin.instructor')->with('success', 'instructor updated successfully');
        }
        if ($instructor->status == 'inactive') {
            $instructor->update(['status' => 'active']);
            return redirect()->route('admin.instructor')->with('success', 'instructor updated successfully');
        }
        return redirect()->route('admin.instructor')->with('error', 'something went wrong , try again');
    }



    public function instructorVideo($id)
    {
        $instructor = Instructor::find($id);
        //Check if video URL exists
        if (empty($instructor->video)) {
            return redirect()->back()->with('error', 'Video not found for this instructor.');
        }
        return view('admin.instructor_video', ['instructor' => $instructor]);
    }
}

<?php

namespace App\Http\Controllers\Mvc\Admins\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstructorRequest;
use App\Models\Instructor;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

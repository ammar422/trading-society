<?php

namespace App\Http\Controllers\Mvc\Admins\Courses;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Instructor;
use App\Traits\MediaTrait;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Notifications\FCMNotification;
use App\Http\Requests\UpdateCourseRequest;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Http\Requests\ApiStoreCourseRequest;
use App\Notifications\NewCourseNotification;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AdminCourseController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.course', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = Instructor::all();
        $categories = Category::all();
        return view('admin.new_course', compact('instructors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApiStoreCourseRequest $request)
    {
        $data = $request->validated();
        $data['photo'] = $this->saveImage('courses_images', $request->photo);
        $course = Course::create($data);

        $users = User::all();
        foreach ($users as $user) {
            $user_id = $user->id;
            $user->notify(new NewCourseNotification($course, $user_id));
        }

        $title = 'Notification for course';
        $body = "course title name is : " . $course->title;
        $course_id = $course->id;


        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        // Create a CloudMessage instance
        $message = CloudMessage::new()
            ->withNotification([
                'title' => $title,
                'body' => $body,
                'course_id' => $course_id
            ]);

        // Send the message as a multicast to all FCM tokens
        $report = Firebase::messaging()->sendMulticast($message, $tokens);

        // Check for any failed tokens
        if (count($report->failures()) > 0) {
            foreach ($report->failures() as $failure) {
                \Log::error("Failed to send to {$failure->target()}: {$failure->error()->getMessage()}");
            }
        }
        if ($course)
            return redirect()->route('admin.courses')->with('success', 'the course addedd successfully , Notifications are being sent to users');
        return redirect()->route('admin.courses')->with('error', 'something went wrong , plz try again');
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
        $course = Course::find($id);
        $instructors = Instructor::all();
        $categories = Category::all();
        return view('admin.edit_course', compact('course', 'instructors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request,  $id)
    {
        $course = Course::find($id);
        $old_photo = Str::after($course->photo, env('APP_URL'));
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $image = $this->saveImage('courses_images', $request->photo);
            $data['photo'] = $image;
        }
        $success = $course->update($data);
        if (is_file(base_path() . $old_photo)) {
            unlink(base_path() . $old_photo);
        }
        if ($success)
            return redirect()->route('admin.courses')->with('success', 'the course updated successfully');
        return redirect()->route('admin.courses')->with('error', 'something went wrong , plz try again');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        $old_photo = $course->photo;
        $success =  $course->delete();
        if ($success) {
            $path = Str::after($old_photo, env('APP_URL'));
            if (is_file(base_path() . $path)) {
                unlink(base_path() . $path);
            }
            return redirect()->route('admin.courses')->with('success', 'course delted successfully');
        }
        return redirect()->route('admin.courses')->with('error', 'something went wrong , try again');
    }
}

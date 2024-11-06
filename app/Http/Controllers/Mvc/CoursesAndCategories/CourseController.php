<?php

namespace App\Http\Controllers\Mvc\CoursesAndCategories;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Traits\MediaTrait;
use Illuminate\Support\Str;
use App\Events\CourseUploaded;
use App\Http\Controllers\Controller;
use App\Notifications\FCMNotification;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\UpdateCourseRequest;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Notifications\NewCourseNotification;
use Illuminate\Support\Facades\Notification;
use Kreait\Laravel\Firebase\Facades\Firebase;


class CourseController extends Controller
{
    use  MediaTrait;




    public function uploadCourse()
    {
        $course = ['title' => 'New Laravel Course', 'author' => 'John Doe']; // Sample course data
        broadcast(new CourseUploaded($course)); // Broadcast the event

        return 'Course uploaded and event broadcasted!';
    }






    public function courseMainPage()
    {
        $instructor = auth('instructor')->user();
        $courses = $instructor->courses()->paginate(5);
        return view('courses', compact('courses'));
    }


    public function create()
    {

        $categories = Category::all();
        return view('add_new_course', compact('categories'));
    }





    public function store(CourseStoreRequest $request)
    {
        $data = $request->validated();
        $data['instructor_id'] = auth('instructor')->id();
        $data['photo'] = $this->saveImage('courses_images', $request->photo);
        $course = Course::create($data);

        $users = User::all();
        foreach ($users as $user) {
            $user_id = $user->id;
            $user->notify(new NewCourseNotification($course, $user_id));
        }
        


        // $title = 'Broadcast Notification';
        // $body = 'This is a notification for all users';
        // $users = User::whereNotNull('fcm_token')->get();
        // foreach ($users as $user) {
        //     $user->notify(new FCMNotification($title, $body));
        // }


        $title = 'Broadcast Notification';
        $body = 'This is a notification for all users';
    
        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
    
        $tokenChunks = array_chunk($tokens, 500);
    
        foreach ($tokenChunks as $tokenChunk) {
            $message = CloudMessage::withTarget('tokens', $tokenChunk)
                ->withNotification(['title' => $title, 'body' => $body]);
    
            Firebase::messaging()->send($message);
        }

        if ($course)
            return redirect()->route('courses.mainPage')->with('success', 'the course addedd successfully');
        return redirect()->route('courses.mainPage')->with('error', 'something went wrong , plz try again');
    }





    public function edit(Course $course)
    {
        $instructorId = auth('instructor')->id();
        if ($course->instructor_id == $instructorId) {
            $categories = Category::all();
            return view('edit_course', compact('course', 'categories'));
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }




    public function update(UpdateCourseRequest $request, Course $course)
    {
        $old_photo = Str::after($course->photo, env('APP_URL'));
        $data = $request->validated();
        $image = $this->saveImage('courses_images', $request->photo);
        $data['photo'] = $image;
        $success = $course->update($data);
        if (is_file(base_path() . $old_photo)) {
            unlink(base_path() . $old_photo);
        }
        if ($success)
            return redirect()->route('courses.mainPage')->with('success', 'the course updated successfully');
        return redirect()->route('courses.mainPage')->with('error', 'something went wrong , plz try again');
    }



    public function destroy(Course $course) // has observer
    {
        $deleted = $course->delete();
        if ($deleted)
            return redirect()->route('courses.mainPage')->with('success', 'the course delted successfully');
        return redirect()->route('courses.mainPage')->with('error', 'something went wrong , plz try again');
    }
}

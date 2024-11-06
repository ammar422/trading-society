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

        // Notify each user in the database
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewCourseNotification($course, $user->id));
        }

        $title = 'Notification for course' . $course->title;
        $body = strval($course->id);

        // Retrieve all FCM tokens
        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        // Create a CloudMessage instance
        $message = CloudMessage::new()
            ->withNotification([
                'title' => $title,
                'body' => $body,
            ]);

        // Send the message as a multicast to all FCM tokens
        $report = Firebase::messaging()->sendMulticast($message, $tokens);

        // Check for any failed tokens
        if (count($report->failures()) > 0) {
            foreach ($report->failures() as $failure) {
                \Log::error("Failed to send to {$failure->target()}: {$failure->error()->getMessage()}");
            }
        }

        if ($course) {
            return redirect()->route('courses.mainPage')->with('success', 'The course was added successfully');
        }
        return redirect()->route('courses.mainPage')->with('error', 'Something went wrong, please try again');
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

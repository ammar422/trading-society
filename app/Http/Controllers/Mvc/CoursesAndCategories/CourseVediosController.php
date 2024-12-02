<?php

namespace App\Http\Controllers\Mvc\CoursesAndCategories;

use App\Models\Course;
use App\Traits\MediaTrait;
use App\Models\CourseVedio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VedioCourseStorRequest;
use App\Http\Requests\UpdateVedioCourseRequest;

class CourseVediosController extends Controller
{
    use MediaTrait;



    public function index($id)
    {
        $course = Course::where('instructor_id', auth('instructor')->id())->find($id);

        if (!$course) {
            return redirect()->route('courses.mainPage')->with('error', 'Sorry, something went wrong.');
        }

        $courseVedios = $course->courseVedios()->orderBy('order')->get();

        return view('course_content', compact('courseVedios'));
    }





    public function create()
    {
        $instructor = auth('instructor')->user();
        $courses = $instructor->courses;
        return view('add_new_video_to_course', compact('courses'));
    }




    public function store(VedioCourseStorRequest $request)
    {
        // Validate the request and get the validated data  
        $data = $request->validated();

        // Save the video and image files  
        $vedio = $this->saveVideo('courses_videos', $request->vedio_url);
        $image = $this->saveImage('courses_images', $request->validated('image'));

        // Append video URL and image to data  
        $data['vedio_url'] = $vedio;
        $data['image'] = $image;

        // Get the course ID (assuming the course ID is passed in the request)  
        $courseId = $request->course_id; // Adjust this line as needed based on your request structure  

        // Get the highest current order from the course's existing videos  
        $maxOrder = CourseVedio::where('course_id', $courseId)->max('order');

        // Set the new order to the max + 1  
        $data['order'] = ($maxOrder ?? 0) + 1; // If maxOrder is null, default to 0  

        // Create the new video  
        $vedio = CourseVedio::create($data);

        // Check if the video was successfully created and redirect with appropriate message  
        if ($vedio) {
            return redirect()->route('courses.add_video')->with('success', 'Video uploaded successfully');
        }

        return redirect()->route('courses.add_video')->with('error', 'Sorry, video can\'t be uploaded');
    }




    public function show($id)
    {
        $courseVedio = CourseVedio::find($id);
        return view('course_watch_vedio', compact('courseVedio'));
    }




    public function edit($id)
    {
        $courseVedio = CourseVedio::find($id);
        $instructor = auth('instructor')->user();
        $courses = $instructor->courses;
        return view('edit_video', compact('courseVedio', 'courses'));
    }




    public function update(UpdateVedioCourseRequest $request, $id)
    {
        // Find the course video by ID  
        $courseVedio = CourseVedio::find($id);

        // Extract old values  
        $old_image = Str::after($courseVedio->image, env('APP_URL'));
        $old_vedio = Str::after($courseVedio->vedio_url, env('APP_URL'));
        $data = $request->validated();

        // Handle video URL update  
        if ($request->has('vedio_url')) {
            $new_vedio = $this->saveVideo('courses_videos', $request->validated('vedio_url'));
            $data['vedio_url'] = $new_vedio;

            // Remove old video file  
            if (is_file(base_path() . $old_vedio)) {
                unlink(base_path() . $old_vedio);
            }
        }

        // Handle image update  
        if ($request->has('image')) {
            $new_image = $this->saveImage('courses_images', $request->validated('image'));
            $data['image'] = $new_image;

            // Remove old image file  
            if (is_file(base_path() . $old_image)) {
                unlink(base_path() . $old_image);
            }
        }

        // Update course video order if provided in request  
        if ($request->has('order')) {
            $newOrder = $request->validated('order');

            // Get the course associated with this video  
            $course = $courseVedio->course; // Assuming there's a relationship defined  

            // Adjust the order of all course videos  
            $courseVideos = $course->courseVedios()->get(); // Fetch all videos for the course  

            // Ensure the new order is within valid range.  
            // You might want to set a limit based on your specific ordering needs.  
            if ($newOrder >= 1 && $newOrder <= $courseVideos->count()) {
                // Adjust other videos' orders accordingly  
                foreach ($courseVideos as $video) {
                    if ($video->id != $courseVedio->id) {
                        // Shift the order of videos that are affected  
                        if ($video->order >= $newOrder) {
                            $video->order++;
                        }
                    }
                }

                // Update the order of all affected videos  
                foreach ($courseVideos as $video) {
                    if ($video->id == $courseVedio->id) {
                        $video->order = $newOrder; // Set the new order for the current video  
                    }
                    $video->save(); // Save changes back to the database  
                }
            }
        }

        // Update the course video with the new data  
        $success = $courseVedio->update($data);

        if ($success) {
            return redirect()->route('course_vedio.edit', $courseVedio->id)
                ->with('success', 'The video updated successfully');
        }

        return redirect()->route('course_vedio.edit', $courseVedio->id)
            ->with('error', 'Sorry, something went wrong');
    }


    public function destroy($id)
    {
        $courseVedio = CourseVedio::find($id);
        $instructor_id =  $courseVedio->course->instructor->id;
        if (auth('instructor')->id() == $instructor_id) {
            $courseVedio->delete();
            return redirect()->route('courses.content', $courseVedio->course->id)->with('success', 'the vedio deleted successfuly');
        }
        return redirect()->route('courses.content', $courseVedio->course->id)->with('error', 'sorry , something went wrong');
    }
}

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



    public function index(Course $course)
    {
        $courseVedios = $course->courseVedios;
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
        $data = $request->validated();
        $vedio = $this->saveVideo('courses_videos', $request->vedio_url);
        $image = $this->saveImage('courses_images', $request->validated('image'));
        $data['vedio_url'] = $vedio;
        $data['image'] = $image;
        $vedio = CourseVedio::create($data);
        if ($vedio)
            return redirect()->route('courses.add_video')->with('success', 'vedio uploaded succesfully ');
        return redirect()->route('courses.add_video')->with('error', 'sorry , vedio cant be uploaded');
    }





    public function show(CourseVedio $courseVedio)
    {
        return view('course_watch_vedio', compact('courseVedio'));
    }




    public function edit(CourseVedio $courseVedio)
    {
        $instructor = auth('instructor')->user();
        $courses = $instructor->courses;
        return view('edit_video', compact('courseVedio', 'courses'));
    }




    public function update(UpdateVedioCourseRequest $request, CourseVedio $courseVedio)
    {
        $old_image = Str::after($courseVedio->image, env('APP_URL'));
        $old_vedio = Str::after($courseVedio->vedio_url, env('APP_URL'));
        $data = $request->validated();

        if ($request->has('vedio_url')) {
            $new_vedio = $this->saveVideo('courses_videos', $request->validated('vedio_url'));
            $data['vedio_url'] = $new_vedio;
            if (is_file(base_path() . $old_vedio))
                unlink(base_path() . $old_vedio);
        }
        if ($request->has('image')) {
            $new_image = $this->saveImage("courses_images", $request->validated('image'));
            $data['image'] = $new_image;
            if (is_file(base_path() . $old_image))
                unlink(base_path() . $old_image);
        }

        $success = $courseVedio->update($data);
        // if ($success)
        //     return redirect()->route('course_vedio.edit', $courseVedio->id)->with('success', 'the vedio updated successfuly');
        // return redirect()->route('course_vedio.edit', $courseVedio->id)->with('error', 'sorry , something went wrong');
    }



    public function destroy(CourseVedio $courseVedio)
    {
        $instructor_id =  $courseVedio->course->instructor->id;
        if (auth('instructor')->id() == $instructor_id) {
            $courseVedio->delete();
            return redirect()->route('courses.content', $courseVedio->course->id)->with('success', 'the vedio deleted successfuly');
        }
        return redirect()->route('courses.content', $courseVedio->course->id)->with('error', 'sorry , something went wrong');
    }
}

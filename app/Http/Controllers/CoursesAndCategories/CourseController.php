<?php

namespace App\Http\Controllers\CoursesAndCategories;

use App\Models\Course;
use App\Models\Category;
use App\Models\Instructor;
use App\Traits\MediaTrait;
use App\Models\CourseVedio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CoursesResource;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\VedioCourseStorRequest;

class CourseController extends Controller
{
    use ApiResponseTrait, MediaTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::paginate(config('constants.PAGINATE_COUNT'));
        $courses = $category->load('courses');
        return $this->successResponse(
            CategoryResource::collection($courses)->response()->getData(true),
            'courses',
            'all courses under each category get successfully'
        );
    }


    public function courseMainPage()
    {
        $instructor = auth('instructor')->user();
        $courses = $instructor->courses()->paginate(5);
        return view('courses', compact('courses'));
    }

    public function getCourseContent(Course $course)
    {
        $courseVedios = $course->courseVedios;
        return view('course_content', compact('courseVedios'));
    }



    public function WatchVedio(CourseVedio $courseVedio)
    {
        return view('course_watch_vedio', compact('courseVedio'));
    }



    public function create()
    {

        $categories = Category::all();
        return view('add_new_course', compact('categories'));
    }



    public function addVideoToCourse()
    {
        $instructor = auth('instructor')->user();
        $courses = $instructor->courses;
        return view('add_new_video_to_course', compact('courses'));
    }

    public function storeVedioToCourse(VedioCourseStorRequest $request)
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


    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStoreRequest $request)
    {
        $data = $request->validated();
        $data['instructor_id'] = auth('instructor')->id();
        $data['photo'] = $this->saveImage('courses_images', $request->photo);
        $course = Course::create($data);
        if ($course)
            return redirect()->route('courses.mainPage')->with('success', 'the course addedd successfully');
        return redirect()->route('courses.mainPage')->with('error', 'something went wrong , plz try again');
    }
    /**
     * Display the specified resource.
     */

    public function show(Course $course)
    {
        $user = Auth::user();
        $course->load('courseVedios');
        $categories = Category::orderBy('order', 'asc')->get();

        $currentCategory = $course->category;

        $currentCategoryIndex = $categories->search(function ($category) use ($currentCategory) {
            return $category->id === $currentCategory->id;
        });

        if ($currentCategoryIndex === 0) {
            return $this->successResponse(
                new CoursesResource($course),
                'course',
                'Course can be accessed because there\'s no previous category.'
            );
        }

        $previousCategory = $categories[$currentCategoryIndex - 1];

        $completedCourse = $user->courses()
            ->where('category_id', $previousCategory->id)
            ->wherePivot('is_completed', 1)
            ->first();

        if ($completedCourse) {
            return $this->successResponse(
                new CoursesResource($course),
                'course',
                'Course can be accessed , User has completed at least one course in the previous category.'
            );
        }
        return $this->failedResponse(
            'You need to complete at lest one course from the previous category before accessing this course.',
            403
        );
    }




    /**
     * Update the specified resource in storage.
     */
    public function edit(Course $course)
    {
        $instructorId = auth('instructor')->id();
        if ($course->instructor_id == $instructorId) {
            $categories = Category::all();
            return view('edit_course', compact('course', 'categories'));
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }


    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $deleted = $course->delete();
        if ($deleted)
            return redirect()->route('courses.mainPage')->with('success', 'the course delted successfully');
        return redirect()->route('courses.mainPage')->with('error', 'something went wrong , plz try again');
    }


    public function markComplete(Course $course)
    {
        $user = Auth::user();
        if ($user->courses->contains($course->id))
            return $this->failedResponse();
        $user->courses()->attach($course->id);
        return $this->successResponse(new CoursesResource($course), 'course', 'the course mark as completed');
    }
}

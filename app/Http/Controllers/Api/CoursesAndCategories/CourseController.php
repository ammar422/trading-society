<?php

namespace App\Http\Controllers\Api\CoursesAndCategories;

use App\Models\Course;
use App\Models\Category;
use App\Traits\MediaTrait;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CoursesResource;
use App\Http\Resources\CategoryResource;


class CourseController extends Controller
{
    use ApiResponseTrait, MediaTrait;
 
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


    public function markComplete(Course $course)
    {
        $user = Auth::user();
        if ($user->courses->contains($course->id))
            return $this->failedResponse();
        $user->courses()->attach($course->id);
        return $this->successResponse(new CoursesResource($course), 'course', 'the course mark as completed');
    }
}

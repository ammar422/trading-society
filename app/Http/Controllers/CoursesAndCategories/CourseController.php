<?php

namespace App\Http\Controllers\CoursesAndCategories;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CoursesResource;
use App\Models\Category;
use App\Models\Course;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class CourseController extends Controller
{
    use ApiResponseTrait;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
                $course,
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
                $course,
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

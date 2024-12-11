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
        $courses = $category->load('courses.instructor',);
        return response()->json([
            'status' => true,
            'message' => 'all courses under each category get successfully',
            'courses' =>  $courses,
        ]);
    }



    // public function show(Course $course)
    // {
    //     $user = Auth::user();
    //     // Load the course videos without ordering for now  
    //     $course->load('courseVedios');

    //     // Order the videos after loading  
    //     $courseVideos = $course->courseVedios->sortBy('order')->values(); // Sort the videos  

    //     // Assuming you already have the $course instance  
    //     $categories = Category::orderBy('order', 'asc')->get();
    //     $currentCategory = $course->category;

    //     $currentCategoryIndex = $categories->search(function ($category) use ($currentCategory) {
    //         return $category->id === $currentCategory->id;
    //     });

    //     if ($currentCategoryIndex == 0) {
    //         return $this->successResponse(
    //             new CoursesResource($course, $courseVideos), // Pass ordered videos to the resource  
    //             'course',
    //             'Course can be accessed because there\'s no previous category.'
    //         );
    //     }

    //     $previousCategory = $categories[$currentCategoryIndex - 1];

    //     $completedCourses = $user->courses()
    //         ->where('category_id', $previousCategory->id)
    //         ->wherePivot('is_completed', 1)
    //         ->get();

    //     if ($completedCourses) {
    //         return $this->successResponse(
    //             new CoursesResource($course, $courseVideos), // Pass ordered videos to the resource  
    //             'course',
    //             'Course can be accessed, User has completed at least one course in the previous category.'
    //         );
    //     }
    //     return $this->failedResponse(
    //         'You need to complete at least one course from the previous category before accessing this course.',
    //         403
    //     );
    // }


    public function show(Course $course)
    {
        $user = Auth::user();

        // Check if the user has a package assigned
        if (is_null($user->package)) {
            return $this->failedResponse(
                'You need to have a package and subscription to access courses.',
                403
            );
        }

        // Define the package permissions
        $packagePermissions = [
            'Essential'     => ['beginners', 'basics'],
            'Basic'         => ['beginners', 'basics'],
            'Premium'       => ['beginners', 'basics', 'advanced'],
            'Pro'           => ['beginners', 'basics', 'advanced', 'expert'],
            'Ultimate'      => ['beginners', 'basics', 'advanced', 'expert', 'expert_plus'],
        ];

        // Check the user's package level
        $userPackage = $user->package; // Assumes package name is stored in a 'package' attribute
        if (!array_key_exists($userPackage, $packagePermissions)) {
            return $this->failedResponse(
                'Invalid package. Please contact support.',
                403
            );
        }

        // Get the list of categories the user can access
        $allowedCategories = $packagePermissions[$userPackage];

        // Check if the course's category is accessible to the user
        if (!in_array($course->category->name, $allowedCategories)) {
            return $this->failedResponse(
                'Your package does not allow access to this course.',
                403
            );
        }

        // Load and sort course videos
        $course->load('courseVedios');
        $courseVideos = $course->courseVedios->sortBy('order')->values();

        return $this->successResponse(
            new CoursesResource($course, $courseVideos),
            'course',
            'Course can be accessed based on your package.'
        );
    }



    public function markComplete(Course $course)
    {
        $user = Auth::user();
        if ($user->courses->contains($course->id))
            return $this->failedResponse('This course is already among the courses that have been marked as finished');
        $user->courses()->attach($course->id);
        return $this->successResponse($course, 'course', 'the course mark as completed');
    }
}

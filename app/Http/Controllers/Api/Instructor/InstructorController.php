<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstructorResource;
use App\Models\Instructor;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    use ApiResponseTrait;


    public function index()
    {
        $instructor = Instructor::paginate(config('constants.PAGINATE_COUNT'));
        return $this->successResponse(
            InstructorResource::collection($instructor)->response()->getData(true),
            'instructors',
            'the instructors list get successfully'
        );
    }


    public function show(Instructor $instructor)
    {
        return $this->successResponse($instructor, 'Instructor');
    }




    public function instructorCourses(Instructor $instructor)
    {
        $instructor->load('courses.courseVedios');
        return $this->successResponse(
            new InstructorResource($instructor),
            'instructor_with_courses',
            'all instructor\'s courses get successfully',
            200
        );
    }
}

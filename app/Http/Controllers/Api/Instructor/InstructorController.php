<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstructorResource;
use App\Models\Instructor;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class InstructorController extends Controller
{
    use ApiResponseTrait;


    public function index()
    {
        $instructors = Instructor::activeInstructors()->whereHas('courses')->paginate(config('constants.PAGINATE_COUNT'));
        if($instructors->isEmpty()){
            return $this->failedResponse('No instructors have courses yet.');
        }
        return $this->successResponse(
            InstructorResource::collection($instructor)->response()->getData(true),
            'instructors',
            'the instructors list get successfully'
        );
    }


    public function show(Instructor $instructor)
    {
        if ($instructor->status == 'active')
            return $this->successResponse($instructor, 'Instructor');
        return $this->failedResponse('not found', 404);
    }




    public function instructorCourses(Instructor $instructor)
    {
        if ($instructor->status == 'active') {
            $instructor->load('courses.courseVedios');
            return $this->successResponse(
                new InstructorResource($instructor),
                'instructor_with_courses',
                'all instructor\'s courses get successfully',
                200
            );
        }
        return $this->failedResponse('not found', 404);
    }



    public function instructorsPerformance()
    {
        // Get instructors with their offers  
        $instructors = Instructor::activeInstructors()->whereHas('offers')->with('offers')->get();

        if ($instructors->isEmpty()) {
            return $this->failedResponse('No instructors have offers yet.');
        }

        // Transform the instructors data  
        $performanceData = $instructors->map(function ($instructor) {
            // Initialize counts for winning and losing trades  
            $winningTrades = 0;
            $losingTrades = 0;

            // Check each offer for order_status  
            foreach ($instructor->offers as $offer) {
                if ($offer->order_status === 'hit_sl') {
                    $losingTrades++;
                } elseif (in_array($offer->order_status, ['hit_tp1', 'hit_tp2', 'hit_tp3', 'hit_tp4', 'hit_tp5'])) {
                    $winningTrades++;
                }
            }

            // Calculate success rate  
            $totalTrades = $winningTrades + $losingTrades;
            $successRate = $totalTrades > 0 ? ($winningTrades / $totalTrades) * 100 : 0;

            // Return the required data  
            return [
                'instructor_id' => $instructor->id,
                'instructor_name' => $instructor->name,
                'instructor_image' => $instructor->photo,
                'instructor_performance' => round($successRate, 2), // Rounded to two decimal places  
            ];
        });
        return $this->successResponse($performanceData, 'instructor_performance_data', 'the instructor performance data get successfully');
    }
}

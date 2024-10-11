<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\OnlineSesions\ZoomController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\CoursesAndCategories\CourseController;
use App\Http\Controllers\CoursesAndCategories\CategoryController;

route::prefix('v1')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');



    Route::post('/register', [AuthController::class, 'register'])->name('user.regiter');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('user.logout');


    route::middleware('auth:sanctum')->group(function () {

        // online zoom sesions
        Route::post('/zoom/meetings', [ZoomController::class, 'createMeeting']);


        // instructor 
        route::apiResource('instructor', InstructorController::class); //It needs to be divided
        route::get('instructor_courses/{instructor}', [InstructorController::class, 'instructorCourses'])->name('instructor.courses');

        //courses
        route::apiResource('courses', CourseController::class); //It needs to be divided
        route::post('complete_course/{course}', [CourseController::class, 'markComplete'])->name('courses.complete_course');


        //offers

        route::get('offers', [OfferController::class, 'index'])->name('offer.index');
        route::get('offers/{offer}', [OfferController::class, 'show'])->name('offer.show');



        //category
        route::get('category', [CategoryController::class, 'index'])->name('category.index');
        route::get('category/{category}', [CategoryController::class, 'show'])->name('category.show');




        // 
    });
});

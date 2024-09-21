<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CoursesAndCategories\CourseController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\OnlineSesions\ZoomController;

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
        route::apiResource('instructor', InstructorController::class);

        //courses
        route::apiResource('courses', CourseController::class);









        // 
    });
});

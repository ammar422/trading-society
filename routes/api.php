<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\AuthInstructorController;
use App\Http\Controllers\Api\Offer\OfferController;
use App\Http\Controllers\Api\OnlineSesions\ZoomController;
use App\Http\Controllers\Api\Instructor\InstructorController;
use App\Http\Controllers\Api\CoursesAndCategories\CourseController;
use App\Http\Controllers\Api\CoursesAndCategories\CategoryController;

route::prefix('v1')->group(function () {


    // user auth
    Route::post('/register', [AuthController::class, 'register'])->name('user.regiter');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');

    // single sign-On 
    Route::post('sso-login', [AuthController::class, 'loginWithSSO']);

    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::middleware('auth:sanctum')->post('delete_acount', [AuthController::class, 'deleteUserAccount'])->name('user.deleteUserAccount');


    // instructor auth
    route::post('instructor_login', [AuthInstructorController::class, 'login'])->name('instructor_api_login');


    // instructor
    route::get('instructor', [InstructorController::class, 'index'])->name('instructor.index');

    //courses
    route::get('courses', [CourseController::class, 'index'])->name('courses.index');


    //offers
    route::get('offers', [OfferController::class, 'index'])->name('offer.index');


    //category
    route::get('category', [CategoryController::class, 'index'])->name('category.index');


    route::middleware('auth:sanctum')->group(function () {

        Route::post('save-fcm-token', [NotificationController::class, 'saveFcmToken']);


        // user profile 
        route::get('user', [AuthController::class, 'getUserData'])->name('user.data');



        // online zoom sesions
        Route::post('/zoom/meetings', [ZoomController::class, 'createMeeting']);

        // instructor 
        // route::apiResource('instructor', InstructorController::class); //It needs to be divided
        route::get('instructor/{instructor}', [InstructorController::class, 'show'])->name('instructor.show');
        route::get('instructor_courses/{instructor}', [InstructorController::class, 'instructorCourses'])->name('instructor.courses');

        //courses
        // route::apiResource('courses', CourseController::class); //It needs to be divided
        route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');
        route::post('complete_course/{course}', [CourseController::class, 'markComplete'])->name('courses.complete_course');

        //offers
        route::get('offers/{offer}', [OfferController::class, 'show'])->name('offer.show');

        //category
        route::get('category/{category}', [CategoryController::class, 'show'])->name('category.show');



        // notification
        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead']);
    });


    // offer for instructor
    route::middleware('auth:instructor-api')->group(function () {
        route::post('instructor/trade-alert', [OfferController::class, 'store']);
    });
});

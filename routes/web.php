<?php

use App\Http\Controllers\Auth\Instructor\InstructorAuthController;
use App\Http\Controllers\CoursesAndCategories\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



route::prefix('instructor')->group(function () {

    route::get('login', [InstructorAuthController::class, 'loginView'])->name('login');
    route::post('login', [InstructorAuthController::class, 'login'])->name('instructor.login');




    Route::middleware('auth:instructor')->group(function () {

        Route::get('/', function () {
            return view('dashboard');
        })->name('instructor.dashboard');
        
        Route::post('/logout', [InstructorAuthController::class, 'logout'])->name('logout');

        // courses route
        route::get('course/main', [CourseController::class, 'courseMainPage'])->name('courses.mainPage');
        route::get('course/add_video', [CourseController::class, 'addVideoToCourse'])->name('courses.add_video');
        route::get('course', [CourseController::class, 'create'])->name('course.create');
        route::post('course' , [CourseController::class , 'store'])->name('course.store');
    });
});

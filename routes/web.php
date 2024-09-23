<?php

use App\Http\Controllers\Auth\Instructor\InstructorAuthController;
use App\Http\Controllers\CoursesAndCategories\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



route::prefix('instructor')->group(function () {

    route::get('login', [InstructorAuthController::class, 'loginView'])->name('login_view');




    // route::middleware('auth:instructor')->group(function () {

        Route::get('/', function () {
            return view('dashboard');
        })->name('instructor.dashboard');


        // courses route
        route::get('course', [CourseController::class, 'create'])->name('course.create');
    // });
});

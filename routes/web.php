<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mvc\Offer\OfferController;
use App\Http\Controllers\Mvc\CoursesAndCategories\CourseController;
use App\Http\Controllers\Mvc\CoursesAndCategories\CategoryController;
use App\Http\Controllers\Mvc\Auth\Instructor\InstructorAuthController;
use App\Http\Controllers\Mvc\CoursesAndCategories\CourseVediosController;

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
        route::get('course', [CourseController::class, 'create'])->name('course.create');
        route::post('course', [CourseController::class, 'store'])->name('course.store');
        route::delete('course/{course}', [CourseController::class, 'destroy'])->name('course.delete');
        route::get('course/{course}', [CourseController::class, 'edit'])->name('course.edit');
        route::post('course/{course}', [CourseController::class, 'update'])->name('course.update');


        //course_vedios route 
        route::get('course_vedios/add_video', [CourseVediosController::class, 'create'])->name('courses.add_video');
        route::post('course_vedios/add_video', [CourseVediosController::class, 'store'])->name('courses.store_vedio');
        route::get('course_vedios/{course}/content', [CourseVediosController::class, 'index'])->name('courses.content');
        route::get('course_vedios/{courseVedio}/vedio_watch', [CourseVediosController::class, 'show'])->name('course.vedio.watch');
        route::get('course_vedios/{courseVedio}/edit', [CourseVediosController::class, 'edit'])->name('course_vedio.edit');
        route::post('course_vedios/{courseVedio}/update', [CourseVediosController::class, 'update'])->name('course_vedio.update');



        // category route
        route::get('levels', [CategoryController::class, 'categoryMainPage'])->name('level.mainpage');
        route::get('levels_edit', [CategoryController::class, 'edit'])->name('level.edit');



        // offers (trade alert) route
        route::get('tarde_alert', [OfferController::class, 'offerMainPage'])->name('offer.mainpage');
        route::get('tarde_alert/{offer}', [OfferController::class, 'offerDetails'])->name('offer.details');
        route::get("new_trade_alert", [OfferController::class, 'newTradeAlert'])->name('offer.addNew');
        route::post("new_trade_alert", [OfferController::class, 'store'])->name('offer.store');
    });
});

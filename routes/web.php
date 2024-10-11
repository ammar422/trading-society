<?php

use App\Http\Controllers\Auth\Instructor\InstructorAuthController;
use App\Http\Controllers\CoursesAndCategories\CategoryController;
use App\Http\Controllers\CoursesAndCategories\CourseController;
use App\Http\Controllers\Offer\OfferController;
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
        route::post('course/add_video', [CourseController::class, 'storeVedioToCourse'])->name('courses.store_vedio');
        route::get('course', [CourseController::class, 'create'])->name('course.create');
        route::get('course/{course}/content', [CourseController::class, 'getCourseContent'])->name('courses.content');
        route::get('course/{courseVedio}/vedio_watch', [CourseController::class, 'WatchVedio'])->name('course.vedio.watch');
        route::post('course', [CourseController::class, 'store'])->name('course.store');
        route::delete('course/{course}', [CourseController::class, 'destroy'])->name('course.delete');

        // category route
        route::get('levels', [CategoryController::class, 'categoryMainPage'])->name('level.mainpage');
        route::get('levels_edit' , [CategoryController::class , 'edit'])->name('level.edit');



        // offers (trade alert) route
        route::get('tarde_alert'  , [OfferController::class , 'offerMainPage'])->name('offer.mainpage');
        route::get('tarde_alert/{offer}'  , [OfferController::class , 'offerDetails'])->name('offer.details');
        route::get("new_trade_alert" , [OfferController::class ,'newTradeAlert' ])->name('offer.addNew');
        route::post("new_trade_alert" , [OfferController::class ,'store' ])->name('offer.store');
    });
});

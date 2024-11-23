<?php

use App\Http\Controllers\Mvc\Admins\Categories\AdminCategoryController;
use App\Http\Controllers\Mvc\Admins\Courses\AdminCourseController;
use App\Http\Controllers\Mvc\Admins\Instructors\AdminInstructorController;
use App\Http\Controllers\Mvc\Admins\Offres\AdminOffersController;
use App\Http\Controllers\Mvc\Admins\SuperAdmins\SuperAdminController;
use App\Http\Controllers\Mvc\Admins\Users\AdminUsersController;
use App\Http\Controllers\Mvc\Auth\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mvc\Offer\OfferController;
use App\Http\Controllers\Mvc\CoursesAndCategories\CourseController;
use App\Http\Controllers\Mvc\CoursesAndCategories\CategoryController;
use App\Http\Controllers\Mvc\Auth\Instructor\InstructorAuthController;
use App\Http\Controllers\Mvc\CoursesAndCategories\CourseVediosController;
use App\Models\Category;
use App\Models\Course;

Route::get('/', function () {
    return view('welcome');
})->name('home');



route::prefix('instructor')->group(function () {
    route::middleware('guest-custom:super_admin')->group(function () {
        route::get('login', [InstructorAuthController::class, 'loginView'])->name('login');
        route::post('login', [InstructorAuthController::class, 'login'])->name('instructor.login');
    });




    Route::middleware('auth:instructor')->group(function () {

        Route::get('/', function () {
            return view('dashboard');
        })->name('instructor.dashboard');

        Route::post('/logout', [InstructorAuthController::class, 'logout'])->name('logout');

        // courses route
        route::get('course/main', [CourseController::class, 'courseMainPage'])->name('courses.mainPage');
        route::get('course', [CourseController::class, 'create'])->name('course.create');
        route::post('course', [CourseController::class, 'store'])->name('course.store');
        route::delete('course/{id}', [CourseController::class, 'destroy'])->name('course.delete');
        route::get('course/{id}', [CourseController::class, 'edit'])->name('course.edit');
        route::post('course/{id}', [CourseController::class, 'update'])->name('course.update');


        //course_vedios route 
        route::get('course_vedios/add_video', [CourseVediosController::class, 'create'])->name('courses.add_video');
        route::post('course_vedios/add_video', [CourseVediosController::class, 'store'])->name('courses.store_vedio');
        route::get('course_vedios/{id}/content', [CourseVediosController::class, 'index'])->name('courses.content');
        route::get('course_vedios/{id}/vedio_watch', [CourseVediosController::class, 'show'])->name('course.vedio.watch');
        route::get('course_vedios/{courseVedio}/edit', [CourseVediosController::class, 'edit'])->name('course_vedio.edit');
        route::post('course_vedios/{courseVedio}/update', [CourseVediosController::class, 'update'])->name('course_vedio.update');
        route::delete('course_vedios/{courseVedio}/delete', [CourseVediosController::class, 'destroy'])->name('course_vedio.delete');



        // category route
        route::get('levels', [CategoryController::class, 'categoryMainPage'])->name('level.mainpage');
        route::get('levels_edit', [CategoryController::class, 'edit'])->name('level.edit');



        // offers (trade alert) route
        route::get('tarde_alert', [OfferController::class, 'offerMainPage'])->name('offer.mainpage');
        route::get('tarde_alert/{id}', [OfferController::class, 'offerDetails'])->name('offer.details');
        route::get("new_trade_alert", [OfferController::class, 'newTradeAlert'])->name('offer.addNew');
        route::post("new_trade_alert", [OfferController::class, 'store'])->name('offer.store');
    });
});

route::prefix('admin')->group(function () {
    route::middleware('guest-custom:super_admin')->group(function () {
        route::get('login', [AdminAuthController::class, 'loginVeiw'])->name('admin.login_veiw');
        route::post('login', [AdminAuthController::class, 'login'])->name('admin.login');
    });


    route::middleware('auth:super_admin')->group(function () {

        Route::get('/', function () {
            $courses = Course::all();
            $levels = Category::all();
            return view('admin.dashboard', compact('courses', 'levels'));
        })->name('admin.dashboard');

        // logout 
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // super admins
        route::get('all_super_admins', [SuperAdminController::class, 'index'])->name('admin.super_admin.index');

        // admin users
        route::get('users/active', [AdminUsersController::class, 'index'])->name('admin.users.active');
        route::get('users/inactive', [AdminUsersController::class, 'Rindex'])->name('admin.users.inactive');
        route::get('users/new', [AdminUsersController::class, 'create'])->name('admin.users.create');
        route::post('users', [AdminUsersController::class, 'store'])->name('admin.users.store');
        route::get('users/{id}/edit', [AdminUsersController::class, 'edit'])->name('admin.users.edit');
        route::post('users/{id}/update', [AdminUsersController::class, 'update'])->name('admin.users.update');
        route::post('users/{id}/change-status', [AdminUsersController::class, 'changeStatus'])->name('admin.users.change-status');
        route::post('users/{id}/delete', [AdminUsersController::class, 'destroy'])->name('admin.users.delete');



        //admin courses
        route::get('courses', [AdminCourseController::class, 'index'])->name('admin.courses');
        route::get('courses/{id}/edit', [AdminCourseController::class, 'edit'])->name('admin.courses.edit');
        route::post('courses/{id}/update', [AdminCourseController::class, 'update'])->name('admin.courses.update');
        route::post('courses/{id}/delete', [AdminCourseController::class, 'destroy'])->name('admin.courses.destroy');
        route::get('courses/new', [AdminCourseController::class, 'create'])->name('admin.courses.create');
        route::post('courses', [AdminCourseController::class, 'store'])->name('admin.courses.store');


        // admin instructors
        route::get("instructors", [AdminInstructorController::class, 'index'])->name('admin.instructor');
        route::get('instructors/new', [AdminInstructorController::class, 'create'])->name('admin.instructor.create');
        route::get('instructors/{id}/edit', [AdminInstructorController::class, 'edit'])->name('admin.instructor.edit');
        route::post('instructors/{id}/update', [AdminInstructorController::class, 'update'])->name('admin.instructor.update');
        route::post('instructors', [AdminInstructorController::class, 'store'])->name('admin.instructor.store');
        route::post('instructors/{id}/delete', [AdminInstructorController::class, 'destroy'])->name('admin.instructor.destroy');
        route::post('instructor/{id}/change_status', [AdminInstructorController::class, 'changeStatus'])->name('admin.instructor.status');



        //admin offers(trade alerts posts)
        route::get('offers', [AdminOffersController::class, 'index'])->name('admin.offers');
        route::get('offers/new', [AdminOffersController::class, 'create'])->name('admin.offers.create');
        route::post('offers', [AdminOffersController::class, 'store'])->name('admin.offers.store');
        route::get('offers/{id}/edit', [AdminOffersController::class, 'edit'])->name('admin.offers.edit');
        route::post('offers/{id}/update', [AdminOffersController::class, 'update'])->name('admin.offers.update');
        route::post('offers/{id}/destroy', [AdminOffersController::class, 'destroy'])->name('admin.offers.destroy');


        //admin levels 
        route::get('levels', [AdminCategoryController::class, 'index'])->name('admin.levels');
        route::get('levels/new', [AdminCategoryController::class, 'create'])->name('admin.levels.create');
        route::post('levels', [AdminCategoryController::class, 'store'])->name('admin.levels.store');
        route::get('levels/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.levels.edit');
        route::post('levels/{id}/update', [AdminCategoryController::class, 'update'])->name('admin.levels.update');
        route::post('levels/{id}/delete', [AdminCategoryController::class, 'destroy'])->name('admin.levels.delete');
    });
});
